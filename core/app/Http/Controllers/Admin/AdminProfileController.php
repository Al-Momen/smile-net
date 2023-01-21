<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\Auth as ModelsAuth;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function adminProfile()
    {
        // dd($request->all());
        $profile = ModelsAuth::with('adminUser')->where('id', Auth::user()->id)->first();
        return view('admin.dashboard.profile', compact('profile'));
    }
    public function storeProfile(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|min:2|max:7',
            'last_name' => 'required|min:2|max:7',
            'user_name' => 'required',
            'designation' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'country' => 'required',
            
        ]);
        $profileStore =  ModelsAuth::where('id', auth()->user()->id)->first();
        $profileStore->username =  $request->user_name;
        $profileStore->mobile_no =  $request->phone_number;
        $profileStore->update();

        $profileStore =  AdminUser::where('id', auth()->user()->id)->first();
        $oldImage = $profileStore->image;
        $profileStore->first_name =  $request->first_name;
        $profileStore->first_name =  $request->first_name;
        $profileStore->last_name =  $request->last_name;
        $profileStore->designation =  $request->designation;
        $profileStore->address =  $request->address;
        $profileStore->country =  $request->country;
        $profileStore->update();
        if($request->hasFile('image')){

            $profileStore->profile_pic =  Generals::update('admin-profile/', $oldImage = null, 'png', $request->image);
            $profileStore->update();
        }
        $notify[] = ['success', 'Admin Profile update Successfully'];
        return redirect()->back()->withNotify($notify);
    }
    public function passwordChange()
    {
        $profile = ModelsAuth::with('adminUser')->where('id', Auth::user()->id)->first();
        return view('admin.dashboard.password_change', compact('profile'));
    }

    public function updatePasssword(Request $request, $id)
    {
 
        //  dd(Hash::make('admin'));
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password',
        ]);

        $profilePassUpdate =  ModelsAuth::where('id', $id)->first();
        if (Hash::check($request->old_password, $profilePassUpdate->password)) {
            $profilePassUpdate->password = Hash::make($request->confirm_password);
            $profilePassUpdate->update();
            $notify[] = ['success', 'Admin password update Successfully'];
            return redirect()->back()->withNotify($notify);
        }
        $notify[] = ['error', 'Your password is not valid'];
        return redirect()->back()->withNotify($notify);
    }
}
