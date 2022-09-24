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
        $profile =  GeneralUser::where('id', Auth::guard('general')->id())->first();
        $request->validate([
            'name' => 'required|min:2|max:255',
            'email' => 'required|unique:general_users',
            'user_name' => 'required',
            'country' => 'required',
            'phone' => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {
                $this->unlink($profile->photo);
                $profile['image'] = $this->uploadImage($request->image, $request->user_name);
            }
            $profile = GeneralUser::where('id', $id)->update([
                'full_name' =>  $request->name,
                'email' =>  $request->email,
                'country_id' => $request->country,
                'user_name' => $request->user_name,
                'phone' => $request->phone,
                'photo' => $profile['image']
            ]);
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
