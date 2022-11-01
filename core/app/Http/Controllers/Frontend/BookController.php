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
use App\Models\BookDetails;
use App\Models\PriceCurrency;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function books()
    {
        $data['general_books'] = Book::with(['category', 'priceCurrency'])->where('bookable_id', Auth::guard('general')->id())->paginate(8);
        // --------------total book count--------------
        $data['general_count'] = Book::where('bookable_id', Auth::guard('general')->id())->where('bookable_type', get_class(Auth::guard('general')->user()))->count();

        // ----------active book count----------
        $data['general_active_count'] = Book::where('bookable_id', Auth::guard('general')->id())->where('bookable_type', get_class(Auth::guard('general')->user()))->where('admin_status', 1)->where('status', 1)->count();

        //    ------------pending book count------------
        $data['general_pending_count'] = Book::where('bookable_id', Auth::guard('general')->id())->where('admin_status', 0)->count();

        //    ------------sold book count------------
         $data['general_sold_count'] = Book::whereHas('bookDetails', function (Builder $query) {
            $query->where('sold', 1);
        })->where('bookable_id', Auth::guard('general')->id())->where('bookable_type', get_class(Auth::guard('general')->user()))->count();

        $data['categories'] = AdminCategory::all();
        $data['price'] = PriceCurrency::first();
        return view('frontend.deshboard.pages.book', $data);
    }
    public function storeBooks(Request $request)
    {
           
        $request->validate([
            'title' => 'required|min:2|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'description' => 'required',
            'file' => 'required',
        ]);
        try {
            $book = new Book();
            $book->bookable_id = Auth::guard('general')->user()->id;
            $book->bookable_type = get_class(Auth::guard('general')->user());
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->status = $request->status;
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
        $book = Book::where('id', $id)->first();
        $categories = AdminCategory::all();
        $price = PriceCurrency::first();
        // dd($categories);
        return view('frontend.deshboard.pages.edit_book', compact('book', 'categories', 'price'));
    }
    public function editStatusBook(Request $request, $id)
    {
        $books = Book::where('id', $id)->first();
        if ($request->status == 'on') {
            $books->status = 1;
            $books->update();
            $notify[] = ['success', 'Event is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $books->status = 0;
            $books->update();
            $notify[] = ['success', 'Event is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function updateBooks(Request $request, $id)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'file' => 'required',
        ]);
        try {
            $book = Book::where('id', $id)->first();
            $oldImage = $book->image;
            $oldFile = $book->file;
            $book->bookable_id = Auth::guard('general')->user()->id;
            $book->bookable_type = get_class(Auth::guard('general')->user());
            $book->title = $request->title;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->status = $request->status;
            $book->tag = $request->tag;
            $book->description = $request->description;
            $book->image = Generals::update('books/', $oldImage, 'png', $request->image);
            $book->file = Generals::FileUpdate('books/', $oldFile, $request->file);
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
