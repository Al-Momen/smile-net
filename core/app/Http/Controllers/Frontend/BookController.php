<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use App\Http\Helpers\Generals;
use App\Models\AdminCategory;

class BookController extends Controller
{

    public function books()
    { 
        
        $data['general_books'] = Book::with(['category'])->where('user_id', Auth::guard('general')->id())->get();
        $data['general_count'] = Book::where('user_id', Auth::guard('general')->id())->count();
        $data['categories'] = AdminCategory::all();
        return view('frontend.deshboard.pages.book',$data);
    }
    public function storeBooks(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'discount' => 'numeric',
        ]);
        try {
            $book = new Book();
            $book->user_id = Auth::guard('general')->user()->id;
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->image = Generals::upload('books/', 'png', $request->image);
            $book->save();
            return redirect()->back()->with('success', "Events create Successfully");
            // return response()->json([
            //     'status'=> 'success',
            //     "message"=>"Event is Created Successfully"
            // ]);
        } catch (QueryException $e) {
            // return response()->json([
            //     'errorMessage' => $event->errors()->all(),
            //     'data' => $event
            // ]);
            dd($e->getMessage());
        }
    }

    public function editBooks($id)
    {
        $book = Book::where('id',$id)->first();
        $categories = AdminCategory::all();
        // dd($categories);
        return view('frontend.deshboard.pages.edit_book', compact('book','categories'));
    }

    public function updateBooks(Request $request, $id)
    {   
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'discount' => 'numeric',
        ]);
        try {
            $book = Book::where('id',$id)->first();
            $oldImage= $book->image;     
            $book->user_id = Auth::guard('general')->user()->id;
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->image = Generals::update('books/', $oldImage,'png', $request->image);
            $book->update();
             return redirect()->route("user.books")->with('success', "Books update Successfully");
            // return response()->json([
            //     'status'=> 'success',
            //     "message"=>"event is successfully"
            // ]);
        } catch (QueryException $e) {
            // return response()->json([
            //     'errorMessage' => $event->errors()->all(),
            //     'data' => $event
            // ]);
            dd($e->getMessage());
        }
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        Generals::unlink("books/", $book->image);
        $book->delete();
        return redirect()->back()->with('success', "Book delete Successfully");;
    }



    // private function uploadImage($file, $title)
    // {

    //     $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
    //     $file_name = $timestamp . '-' . $title . '.' . $file->getClientOriginalExtension();
    //     $pathToUpload = storage_path() . '\app\public\books/';  // image  upload application save korbo
    //     if (!is_dir($pathToUpload)) {
    //         mkdir($pathToUpload, 0755, true);
    //     }
    //     Image::make($file->getPathname())->resize(800, 400)->save($pathToUpload . $file_name);
    //     return $file_name;
    // }
    // private function unlink($file)
    // {
    //     $pathToUpload = storage_path() . '\app\public\books/';
    //     if ($file != '' && file_exists($pathToUpload . $file)) {
    //         @unlink($pathToUpload . $file);
    //     }
    // }
}
