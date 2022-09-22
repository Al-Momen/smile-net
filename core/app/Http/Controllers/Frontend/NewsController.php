<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class NewsController extends Controller
{
    public function storeNews(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'date' => 'required',
            'image' => 'required',
        ]);
       
        try {
            if ($request->hasFile('image')) {
                // unlink("images/" . $news->image);
                $news['image'] = $this->uploadImage($request->image, $request->title);
                      
            }
            $news = News::create([
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'user_id' => Auth::guard('general')->id(),
                'image' => $news['image']
            ]);
            return redirect()->back()->with('success', "News create Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $news = News::find($id);
        $this->unlink($news->image);
        $news->delete();
        return redirect()->back()->with('success', "News delete Successfully");;
    }

    private function uploadImage($file, $title)
    {
        
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $title . '.' . $file->getClientOriginalExtension();
        $pathToUpload = storage_path() . '\app\public\news/';  // image  upload application save korbo
        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($file->getPathname())->resize(800, 400)->save($pathToUpload . $file_name);
        return $file_name;

    }
    private function unlink($file)
    {
        $pathToUpload = storage_path() . '\app\public\news/';
        if ($file != '' && file_exists($pathToUpload . $file)) {
            @unlink($pathToUpload . $file);
        }
    }
}
