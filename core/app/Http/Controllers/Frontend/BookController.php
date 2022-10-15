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
use App\Models\PriceCurrency;

class BookController extends Controller
{
    public function books()
    { 
        $data['general_books'] = Book::with(['category','price'])->where('user_id', Auth::guard('general')->id())->paginate(8);
        $data['general_count'] = Book::where('user_id', Auth::guard('general')->id())->count();
        $data['categories'] = AdminCategory::all();
        $data['prices'] = PriceCurrency::all();
        return view('frontend.deshboard.pages.book',$data);
    }
    public function storeBooks(Request $request)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price_id' => 'required',
            'price' => 'required',
            'file' => 'required',
            'discount' => 'numeric',
            'coupon' => 'min:6|max:8',
        ]);
        try {
            $book = new Book();
            $book->user_id = Auth::guard('general')->user()->id;
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->coupon = $request->coupon;
            $book->tag = $request->tag;
            $book->image = Generals::upload('books/', 'png', $request->image);
            $book->file = Generals::fileUpload('books/', $request->file);
            $book->save();
            return redirect()->back()->with('success', "Events create Successfully");
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editBooks($id)
    {
        $book = Book::where('id',$id)->first();
        $categories = AdminCategory::all();
        $prices = PriceCurrency::all();
        // dd($categories);
        return view('frontend.deshboard.pages.edit_book', compact('book','categories','prices'));
    }
    public function updateBooks(Request $request, $id)
    {   
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price_id' => 'required',
            'price' => 'required',
            'file' => 'required',
            'discount' => 'numeric',
            'coupon' => 'min:6|max:8',
        ]);
        try {
            $book = Book::where('id',$id)->first();
            $oldImage= $book->image;     
            $oldFile= $book->file;     
            $book->title = $request->title;
            $book->user_id = Auth::guard('general')->user()->id;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->discount = $request->discount;
            $book->coupon = $request->coupon;
            $book->tag = $request->tag;
            $book->description = $request->description;
            $book->image = Generals::update('books/', $oldImage,'png', $request->image);
            $book->file = Generals::FileUpdate('books/',$oldFile, $request->file);
            $book->update();
             return redirect()->route("user.books")->with('success', "Books update Successfully");
        } catch (QueryException $e) {
          dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        Generals::unlink("books/", $book->image);
        Generals::fileUnlink("books/", $book->file);
        $book->delete();
        return redirect()->back()->with('success', "Book delete Successfully");;
    }
    
}
