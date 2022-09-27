<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Storage;

class Generals
{
    //Image upload
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
    public static function unlink($file)
    {
        $pathToUpload = storage_path() . '\app\public\events/';
        if ($file != '' && file_exists($pathToUpload . $file)) {
            @unlink($pathToUpload . $file);
        }
    }
}
