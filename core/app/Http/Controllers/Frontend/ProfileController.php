<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralUser;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
       $profile =  GeneralUser::where('id', Auth::guard('general')->id())->first();
        return view('frontend.deshboard.pages.profile',compact('profile'));
    }

    public function update(Request $request ,$id)
    {
        //  dd($request->all());
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required',
            'user_name' => 'required',
            'country' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);
        try {
            $profile = GeneralUser::where('id',$id)->first();
            $profile->full_name = $request->name;
            $profile->email= $request->email;
            $profile->country_id = $request->country;
            $profile->user_name = $request->user_name;
            $profile->phone= $request->phone;
            $profile->facebook= $request->facebook;
            $profile->instagram= $request->instagram;
            $profile->twitter= $request->twitter;
            $profile->photo = Generals::upload('profile/', 'png', $request->image);
            $profile->update();
            return redirect()->back()->with('success', "Profile Update Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

}
