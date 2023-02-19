<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Mail\VerifyEmail;
use App\Models\UserWallet;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class UsersAuthController extends Controller
{
    // user Login form function
    public function userLoginForm()
    {
        return view('frontend.auth.login');
    }
    // user Regstration form function
    public function userRegistrationForm(Request $request)
    {

        if ($request->isMethod('post')) {
            //  dd($request->all());
            $data = $request->validate([
                'fullname' => 'required',
                'email' => 'required|unique:general_users',
                'phone' => 'required',
                'password' => 'required',
                'password' => 'required',
                'country' => 'required',
                'confirm_password' => 'required|same:password',
            ]);
            $data = $request->all();
            $general_user = new GeneralUser();
            $general_user->full_name = $data['fullname'];
            $general_user->email = $data['email'];
            $general_user->phone = $data['phone'];
            $general_user->verified_code = rand(1234567, 7654321);
            $general_user->country = $data['country'];
            $general_user->password = Hash::make($data['password']);
            $general_user->save();

            $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $general_user->full_name;
            $subject = 'Welcome ' . strtoupper($config->name) . ' Mail';
            $message = 'Your verification Code' . ' ' . $general_user->verified_code;
            sendGeneralEmail($request->email, $subject, $message, $receiver_name);

            // Mail::to($general_user->email)->send(new VerifyEmail($general_user->verified_code));
            if ($general_user->verified_code) {
                $notify[] = ['success', "User Create Successfully"];
                return redirect()->route("otp.form")->withNotify($notify);
                // return redirect()->route('otp.form')->with('success', "User Create Successfully");
            }
        }
        return view('frontend.auth.regstration');
    }

    public function userLogin(Request $request)
    {
        return view('frontend.auth.login');
    }

    public function loginAction(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::guard('general')->attempt(['email' => $request->email, 'password' => $request->password,])) {
                if (Auth::guard('general')->attempt(['email' => $request->email, 'password' => $request->password, "status" => 1], $request->has('remember'))) {
                    if (Auth::guard('general')->attempt(['email' => $request->email, 'password' => $request->password, "status" => 1, "access" => 0])) {

                        // ---------------------user wallet create---------------------
                        $user_wallet = UserWallet::where('user_id', Auth::guard('general')->user()->id)->first();
                        if ($user_wallet) {
                            return redirect()->intended(route('user.deshboard'));
                        } else {
                            $user_wallet = new UserWallet();
                            $user_wallet->user_id = Auth::guard('general')->user()->id;
                            $user_wallet->save();
                        }
                        return redirect()->intended(route('user.deshboard'));
                    } else {
                        return redirect()->back()->withErrors('Your Account banned');
                    }
                } else {
                    $general_users = DB::table('general_users')->where('email', $data['email'])->first();
                    $general = GeneralSetting::first();
                    $config = $general->mail_config;
                    $receiver_name = $general_users->full_name;
                    $subject = 'Welcome ' . strtoupper($config->name) . ' Mail';
                    $message = 'Your varification Code' . ' ' . $general_users->verified_code;
                    sendGeneralEmail($request->email, $subject, $message, $receiver_name);
                    $notify[] = ['error', "Please Verify your email"];
                    return redirect()->route("otp.form")->withNotify($notify);
                }
            }
        }

        $notify[] = ['error', "Invalid password"];
        return redirect()->back()->withNotify($notify);
        
    }

    //user otp Check functon
    public function userOtpForm()
    {
        return view('frontend.auth.verify_otp');
    }

    // user otp Check functon
    public function userOtp(Request $request)
    {
        $user = DB::table('general_users')->where('verified_code', $request->verified_code)->first();

        if ($user != null) {

            if ($user->verified_code == $request->verified_code) {
                $update = DB::table('general_users')->where('id', $user->id)->update(['status' => 1]);
                Auth::guard('general')->loginUsingId($user->id);
                $notify[] = ['success', "user is Verifyed"];
                return redirect()->route("user.deshboard")->withNotify($notify);
            }
        } else {
            $notify[] = ['error', "OTP doesn't match"];
            // return redirect()->back()->withNotify('success', 'You Vote successfully');
            return redirect()->back()->withNotify($notify);
        }
    }

    public function logout()
    {
        if (Auth::guard('general')->check()) {
            Session::flush();
            Auth::guard('general')->logout();
        }
        return redirect()->route('login');
    }



    // ----------------------------user Forgot password ----------------------------
    public function passwordResetEmailView()
    {
        // return view('frontend.deshboard.pages.password_reset_email');
        return view('frontend.auth.forgot-password.password_reset_email');
    }

    public function passwordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        // dd($request->all());
        $profile = GeneralUser::where('email', $request->email)->where('access', 0)->first();
        if ($profile) {
            $profile->update([
                'verified_code' => rand(123456789, 987654321)
            ]);
            // Mail::to($profile->first()->email)->send(new VerifyEmail($profile->first()->verified_code));
            $general = GeneralSetting::first();
            $config = $general->mail_config;
            $receiver_name = $profile->full_name;
            $subject = 'Welcome ' . strtoupper($config->name) . ' Mail';
            $message = 'Password reset Verification Code' . ' ' . $profile->verified_code;
            sendGeneralEmail($request->email, $subject, $message, $receiver_name);
            $encreptProfileId = encrypt($profile->id);

            $notify[] = ['success', "Please Check your Email"];
            return redirect()->route('password.reset.otp.form', $encreptProfileId)->withNotify($notify);
        } else {
            
            $notify[] = ['success', "Your Email is not Valid"];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function userPasswordResetOtpForm($id)
    {
        $profileId = $id;
        return view('frontend.auth.forgot-password.verify_otp_password_reset', compact('profileId'));
    }

    public function passwordResetOTPCheck(Request $request)
    {

        $profileId = decrypt($request->id);

        $reset_otp = GeneralUser::where('verified_code', $request->verified_code)->where('id', $profileId)->first();
        $profile = $reset_otp;
        if ($reset_otp) {
            $encreptProfileId = encrypt($profile->id);
            return redirect()->route('password.reset.view', $encreptProfileId);
        } else {
            // return redirect()->route('password.reset.email.view')->with('danger', 'Your OTP is not verifyed');
            $notify[] = ['error', "Your OTP doesn't match"];
            return redirect()->route('password.reset.email.view')->withNotify($notify);
            
        }
    }
    public function passwordResetView($id)
    {
        $profileId = $id;
        return view('frontend.auth.forgot-password.password_reset', compact('profileId'));
    }


    public function passwordReset(Request $request)
    {

        $request->validate([
            'new_pass' => 'required|min:5',
            'confirm_pass' => 'required|same:new_pass',
        ]);

        $ProfileId = decrypt($request->profile_id);
        try {
            $profile = GeneralUser::where('id', $ProfileId)->first();
            $profile->password = Hash::make($request->new_pass);
            $profile->update();
            Auth::guard('general')->loginUsingId($profile->id);
            ddd('ok');
            $notify[] = ['success', "Password Update Successfully"];
            return redirect()->route('user.deshboard')->withNotify($notify);
    
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
}
