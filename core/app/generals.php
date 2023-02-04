<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

class Generals
{
    //Image upload
    public static function logoupload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = 'whiteLogo' . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            // dd(file_get_contents($image));
            // dd($imageName);
            return $imageName;
        } else {
            $imageName = 'def.png';
        }
        return $imageName;
    }
    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = \Carbon\Carbon::now()->toDateString() . "-" . time() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            // dd(file_get_contents($image));
            // dd($imageName);
            return $imageName;
        } else {
            $imageName = 'def.png';
        }
        return $imageName;
    }
    // Image update
    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if ($image == null) {
            return $old_image;
        }
        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = Generals::upload($dir, $format, $image);
        return $imageName;
    }
    // Image delete
    public static function unlink(string $dir,$file)
    {
        $pathToUpload = storage_path() . '\app\public'. '\\'.$dir;
        if ($file != '' && file_exists($pathToUpload . $file)) {
            @unlink($pathToUpload . $file);
        }
    }


    //File upload
    public static function fileUpload(string $dir, $file = null)
    {
        if ($file != null) {
            $fileName = \Carbon\Carbon::now()->toDateString() . "-" . time() . "." . $file->getClientOriginalExtension();
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $fileName, file_get_contents($file));
            // dd(file_get_contents($image));
            // dd($imageName);
           
            return $fileName;
        } else {
            $fileName = null;
        }
        return $fileName;
    }

     // File update
     public static function FileUpdate(string $dir, $old_file, $file = null)
     {
         if ($file == null) {
             return $old_file;
         }
         if (Storage::disk('public')->exists($dir . $old_file)) {
             Storage::disk('public')->delete($dir . $old_file);
         }
         $fileName = Generals::fileUpload($dir, $file);
         return $fileName;
     }
     // File delete
     public static function fileUnlink(string $dir,$file)
     {
         $pathToUpload = storage_path() . '\app\public'. '\\'.$dir;
         if ($file != '' && file_exists($pathToUpload . $file)) {
             @unlink($pathToUpload . $file);
         }
     }
}
