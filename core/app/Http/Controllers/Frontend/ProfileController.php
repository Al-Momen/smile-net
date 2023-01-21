<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Mail\VerifyEmail;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use App\Models\GeneralSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\TicketTypeDetails;
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
        $ticketTypeDetails =  TicketTypeDetails::with('ticket_type')->where('user_id', Auth::guard('general')->id())->where('status', 1)->where('ticket_status',1)->first();
        return view('frontend.deshboard.pages.profile', compact('profile','ticketTypeDetails'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:2|max:255',
            'country' => 'required',
            'phone' => 'required',
            
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
            $profile->update();
            if ($request->hasFile('image')) {
                $location = imagePath()['profile']['user']['path'];
                $size = imagePath()['profile']['user']['size'];
                $old = $profile->image;
                $filename = uploadImage($request->image, $location, $size, $old);
                $profile->photo = $filename;
                $profile->update();
            }
            $notify[] = ['success', "Profile Update Successfully"];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    } 

    // ------------------------------password change------------------------------
    public function passwordChange()
    {
        $profile = GeneralUser::where('id', Auth::guard('general')->user()->id)->first();
        return view('frontend.deshboard.profile.password_change',compact('profile'));
    }
    public function passwordChangeStore(Request $request)
    {
        $request->validate([
            'old_pass' => 'required',
            'new_pass' => 'required',
            'confirm_pass' => 'required|same:new_pass',
        ]);
        
        $profilePassUpdate =  GeneralUser::where('id', $request->profile_id)->first();

        if (Hash::check($request->old_pass, $profilePassUpdate->password)) {
            $profilePassUpdate->password = Hash::make($request->confirm_pass);
            $profilePassUpdate->update();
            
            $notify[] = ['success', 'Your password update Successfully'];
            return redirect()->route('user.deshboard')->withNotify($notify);
        }
        
        return redirect()->back()->with('danger', 'Your password is not Valid');
    }

    // ----------------------------user password reset----------------------------
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
            return redirect()->route('password.reset.otp.form', $profile->id);
        } else {
            return redirect()->back()->with('danger', 'Please Email is not verifyed');
        }
    }
    public function userPasswordResetOtpForm($id)
    {
        $profileId = $id;
        return view('frontend.auth.forgot-password.verify_otp_password_reset', compact('profileId'));
    }

    public function passwordResetOTPCheck(Request $request)
    {
        $reset_otp = GeneralUser::where('verified_code', $request->verified_code)->where('id', $request->id)->first();
        $profile = $reset_otp;
        if ($reset_otp) {
            
            return redirect()->route('password.reset.view', $profile->id);
        } else {
            return redirect()->route('password.reset.email.view')->with('danger', 'Please OTP is not verifyed');
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
        try {
            $profile = GeneralUser::where('id', $request->profile_id)->first();
            $profile->password = Hash::make($request->new_pass);
            $profile->update();
            return redirect()->route('login')->with('success', "Password Update Successfully");

        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
}
