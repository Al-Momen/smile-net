<?php

namespace App\Http\Controllers\FrontEnd;

use Exception;
use Carbon\Carbon;
use App\Mail\VerifyEmail;
use App\Models\VerifyUser;
use App\Models\GeneralUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\User\UserRegstrationRequest;

class UserAuthController extends Controller
{
    // user Login form function
    public function userLoginForm()
    {
        return view('frontend.Auth.login');
    }
    // user Regstration form function
    public function userRegstrationForm()
    {
        return view('frontend.Auth.regstration');
    }
    // user Regstration function
    public function userRegstration(UserRegstrationRequest $request)
    {
        try {
            $general_user = GeneralUser::create([
                'full_name' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'verified_code' => rand(123456, 654321),
                'phone' => $request->phone,
                'country_id' => $request->country,
                'password' => Hash::make($request->password)
            ]);
            Mail::to($general_user->email)->send(new VerifyEmail($general_user->verified_code));
            if ($general_user->verified_code) {
                return view('frontend.Auth.verify_otp')->with('success', "User Create Successfully");
            }
        } catch (Exception $e) {
            return redirect()->back($e->getMessage());
        }
    }
    // user login function
    public function userLogin(Request $request)
    {

        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::guard('general_user')->attempt(['email' => $request->email, 'password' => $request->password,])) {
            if (Auth::guard('general_user')->attempt(['email' => $request->email, 'password' => $request->password, "status" => 1], $request->has('remember'))) {
                return redirect()->route('user.deshboard');
            } else {
                $general_users = DB::table('general_users')->where('email', $request->email)->first();
                Mail::to($general_users->email)->send(new VerifyEmail($general_users->verified_code));
                return redirect()->route('user.otp.form')->with('info','Please Verify your email');
            }
        } else {
            return redirect()->back()->withErrors('Access denied');
        }
    }
    public function userLogout()
    {
        if (Auth::guard('general_user')->check()) {
            Session::flush();
            Auth::guard('general_user')->logout();
        }
        return redirect()->route('user.login.form');
    }
    // user otp Check functon
    public function userOtpForm()
    {
        return view('frontend.Auth.verify_otp');
    }
    // user otp Check functon
    public function userOtp(Request $request)
    {
        $user = DB::table('general_users')->where('verified_code', $request->verified_code)->first();
        if ($user->verified_code == $request->verified_code) {
            $update = DB::table('general_users')->where('id', $user->id)->update(['status' => 1]);
            return redirect()->route("user.login.form")->with('success', "User is Verified");
        }
    }
}
