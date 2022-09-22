<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class BookController extends Controller
{
    public function storeBooks(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'date' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        try {
            if ($request->hasFile('image')) {
                // unlink("images/" . $news->image);
                $books['image'] = $this->uploadImage($request->image, $request->title);
            }
            $books = Book::create([
                'user_id' => Auth::guard('general')->id(),
                'category_id' => $request->category_id,
                'title' => $request->title,
                'description' => $request->description,
                'date' => $request->date,
                'price' => $request->price,
                'image' => $books['image']
            ]);
            return redirect()->back()->with('success', "News create Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $this->unlink($book->image);
        $book->delete();
        return redirect()->back()->with('success', "Book delete Successfully");;
    }

    private function uploadImage($file, $title)
    {

        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $timestamp . '-' . $title . '.' . $file->getClientOriginalExtension();
        $pathToUpload = storage_path() . '\app\public\books/';  // image  upload application save korbo
        if (!is_dir($pathToUpload)) {
            mkdir($pathToUpload, 0755, true);
        }
        Image::make($file->getPathname())->resize(800, 400)->save($pathToUpload . $file_name);
        return $file_name;
    }
    private function unlink($file)
    {
        $pathToUpload = storage_path() . '\app\public\books/';
        if ($file != '' && file_exists($pathToUpload . $file)) {
            @unlink($pathToUpload . $file);
        }
    }
}
