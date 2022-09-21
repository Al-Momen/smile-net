<?php

namespace App\Http\Controllers\Frontend;

use Exception;
use App\Mail\VerifyEmail;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
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

            $data = $request->all();
            // dd($data['fullname']);
            $general_user = GeneralUser::create([

                'full_name' => $data['fullname'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'verified_code' => rand(123456, 654321),
                'country_id' => $data['country'],
                'password' => Hash::make($data['password'])
            ]);
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
                    return redirect()->route('user.deshboard');
                } else {
                    $general_users = DB::table('general_users')->where('email', $data['email'])->first();
                    Mail::to($general_users->email)->send(new VerifyEmail($general_users->verified_code));
                    return redirect()->route('otp.form')->with('info', 'Please Verify your email');
                }
            }
        }
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