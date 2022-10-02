<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralUser;
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
            $profile->photo = GeneralUser::upload('profiles/', 'png', $request->image);
            $profile->update();
            return redirect()->back()->with('success', "Profile Update Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    private function uploadImage($file, $title)
    {

        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $title . '.' . $file->getClientOriginalExtension();
        $pathToUpload = storage_path() . '\app\public\profile/';  // image  upload application save korbo
        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($file->getPathname())->resize(800, 400)->save($pathToUpload . $file_name);
        return $file_name;
    }
    private function unlink($file)
    {
        $pathToUpload = storage_path() . '\app\public\profile/';
        if ($file != '' && file_exists($pathToUpload . $file)) {
            @unlink($pathToUpload . $file);
        }
    }
}
