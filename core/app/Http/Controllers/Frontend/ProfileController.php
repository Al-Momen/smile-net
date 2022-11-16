<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Mail\VerifyEmail;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $profile =  GeneralUser::where('id', Auth::guard('general')->id())->first();
        return view('frontend.deshboard.pages.profile', compact('profile'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:2|max:255',
            'user_name' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);
        try {
            $profile = GeneralUser::where('id', $id)->first();
            $profile->full_name = $request->name;
            $profile->country = $request->country;
            $profile->user_name = $request->user_name;
            $profile->phone = $request->phone;
            $profile->facebook = $request->facebook;
            $profile->instagram = $request->instagram;
            $profile->twitter = $request->twitter;
            $profile->photo = Generals::upload('profile/', 'png', $request->image);
            $profile->update();
            return redirect()->back()->with('success', "Profile Update Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    // ----------------------------user password reset----------------------------
    public function passwordResetEmailView()
    {
        return view('frontend.deshboard.pages.password_reset_email');
    }
    
    public function passwordResetEmail(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);
        // dd($request->all());
        $profile = DB::table('general_users')->where('email', $request->email);
        if($profile->first()){
            $profile->update([
                'verified_code' => rand(123456789, 987654321)
            ]);
            Mail::to($profile->first()->email)->send(new VerifyEmail($profile->first()->verified_code));
            return redirect()->route('user.password.reset.otp.form',$profile->first()->id);
        }else{
            return redirect()->back()->with('danger', 'Please Email is not verifyed');
        }
    }
    public function userPasswordResetOtpForm($id){
       $profileId = $id;
        return view('frontend.deshboard.pages.verify_otp_password_reset',compact('profileId'));
    }
    
    public function passwordResetOTPCheck(Request $request, $id)
    {
        $profileId = $id;
        $reset_otp = GeneralUser::where('verified_code',$request->verified_code)->where('id',$id)->first();
        if($reset_otp){
            return redirect()->route('user.password.reset.view',$profileId);
        }else{
            return redirect()->route('user.password.reset.email.view')->with('danger', 'Please OTP is not verifyed');
        }
    }
    
    public function passwordResetView($id){
        
        $profileId = $id;
        return view('frontend.deshboard.pages.password_reset',compact('profileId'));
    }


    public function passwordReset(Request $request, $id)
    {
        $request->validate([
            'current_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required|same:new_pass',
        ]);
        try {
            if (Auth::guard('general')->attempt(['id' => $id, 'password' => $request->current_pass])) {
                $profile = GeneralUser::where('id', $id)->first();
                $profile->password = Hash::make($request->new_pass);
                $profile->update();
                return redirect()->route('user.deshboard')->with('success', "Password Update Successfully");
            } else {
                return redirect()->route('user.password.reset.email.view')->with('danger', 'Your Current Password is not Valid, Try again');
            }
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
}
