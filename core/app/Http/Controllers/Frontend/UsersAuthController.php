<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Mail\VerifyEmail;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UserWallet;
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
        // dd($request->all());
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'fullname' => 'required',
                'email' => 'required|unique:general_users',
                'phone' => 'required',
                'password' => 'required',
                'country' => 'required',
            ]);
            $data = $request->all();
            $general_user = new GeneralUser();
            $general_user->full_name = $data['fullname'];
            $general_user->email = $data['email'];
            $general_user->phone = $data['phone'];
            $general_user->verified_code = rand(123456789, 987654321);
            $general_user->country = $data['country'];
            $general_user->password = Hash::make($data['password']);
            $general_user->save();
            
            Mail::to($general_user->email)->send(new VerifyEmail($general_user->verified_code));
            if ($general_user->verified_code) {
                return redirect()->route('otp.form')->with('success', "User Create Successfully");
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


                    // ---------------------user wallet create---------------------
                    $user_wallet = UserWallet::where('user_id', Auth::guard('general')->user()->id)->first();
                    if($user_wallet){
                        return redirect()->intended(route('user.deshboard'));
                    }
                    else{
                        $user_wallet = new UserWallet();
                        $user_wallet->user_id = Auth::guard('general')->user()->id;
                        $user_wallet->save();
                    }
                    return redirect()->intended(route('user.deshboard'));
                } else {
                    $general_users = DB::table('general_users')->where('email', $data['email'])->first();
                    Mail::to($general_users->email)->send(new VerifyEmail($general_users->verified_code));
                    return redirect()->route('otp.form')->with('info', 'Please Verify your email');
                }
            }
        }
        return redirect()->back()->withErrors('Access denied');;
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
        if ($user->verified_code == $request->verified_code) {
            $update = DB::table('general_users')->where('id', $user->id)->update(['status' => 1]);
            return redirect()->route("login")->with('success', "User is Verified");
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
      
    
}
