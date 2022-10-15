<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Models\PriceCurrency;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminBookController extends Controller
{
    public function index()
    { 
        
        $data['general_books'] = Book::with(['category','price'])->where('user_id', Auth::user()->id)->paginate(8);
        $data['general_count'] = Book::where('user_id', Auth::guard('general')->id())->count();
        $data['categories'] = AdminCategory::all();
        $data['prices'] = PriceCurrency::all();
        return view('admin.books.book',$data);
    }
    public function storeBook(Request $request)
    {
        // dd($request->all());
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
            $book->user_id = Auth::user()->id;
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
}
