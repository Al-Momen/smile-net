<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Models\PriceCurrency;
use App\Http\Helpers\Generals;
use App\Models\BookTransaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;

class BookController extends Controller
{
    public function books()
    {
        $data['general_books'] = Book::with(['category', 'priceCurrency'])->where('author_book_id', Auth::guard('general')->id())->orderBy('id','desc')->paginate(10);
        // --------------total book count--------------
        $data['general_count'] = Book::where('author_book_id', Auth::guard('general')->id())->where('author_book_type', get_class(Auth::guard('general')->user()))->count();

        // ----------active book count----------
        $data['general_active_count'] = Book::where('author_book_id', Auth::guard('general')->id())->where('author_book_type', get_class(Auth::guard('general')->user()))->where('status', 1)->count();

        //    ------------pending book count------------
        $data['general_pending_count'] = Book::where('author_book_id', Auth::guard('general')->id())->where('status', 0)->count();

        //    ------------sold book count------------
        $data['general_sold_count'] = BookTransaction::where('author_book_id', Auth::guard('general')
            ->user()->id)
            ->where('author_book_type', 'App\Models\GeneralUser')
            ->where('status', 1)->count();

        $data['categories'] = AdminCategory::all();
        $data['price'] = PriceCurrency::first();
        $data['empty_data'] = "No data found";
        return view('frontend.deshboard.pages.book',$data);
    }
    public function storeBooks(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf|max:100000',
        ]);
        try {
            $book = new Book();
            $book->author_book_id = Auth::guard('general')->user()->id;
            $book->author_book_type = get_class(Auth::guard('general')->user());
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->tag = $request->tag;
            $book->image = Generals::upload('books/', 'png', $request->image);
            $book->file = Generals::fileUpload('books/', $request->file);
            $book->save();
            $notify[] = ['success',$book->title.' '."Books create Successfully"];
            return redirect()->back()->withNotify($notify);
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
        // dd($request->status);
        $books = Book::where('id', $id)->first();
        if ($request->status == 'on') {
            $books->status = 1;
            $books->update();
            $notify[] = ['success', $books->title.' '.'books is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $books->status = 0;
            $books->update();
            $notify[] = ['success', $books->title.' '.'books is Inactive'];
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
            'image' => 'image|mimes:jpeg,png,jpg,svg,webp',
            'price' => 'required',
            'file' => 'mimes:pdf|max:100000',
        ]);
        try {
            $book = Book::where('id', $id)->first();
            $oldImage = $book->image;
            $oldFile = $book->file;
            $book->author_book_id = Auth::guard('general')->user()->id;
            $book->author_book_type = get_class(Auth::guard('general')->user());
            $book->title = $request->title;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->tag = $request->tag;
            $book->description = $request->description;
            $book->update();
            if ($request->hasFile('image')) {
                $book->image = Generals::update('books/', $oldImage, 'png', $request->image);
                $book->update();
            }
            if ($request->hasFile('file')) {
                $book->file = Generals::FileUpdate('books/', $oldFile, $request->file);
                $book->update();
            }
            $notify[] = ['success', $book->title.' '."books update Successfully"];
            return redirect()->route("user.books")->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function sold_out($id)
    {
        
        $sold_book_history = BookTransaction::where('book_id', $id)->where('status', '=', 1)->orderBy('id','desc')->paginate(8);
        $currency = PriceCurrency::first();
        $empty_message = "No data Found";
        return view('frontend.deshboard.pages.sold-books.sold_books',compact(
            'sold_book_history',
            'currency',
            'empty_message',
        ));
        
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        Generals::unlink("books/", $book->image);
        Generals::fileUnlink("books/", $book->file);
        $book->delete();
        $notify[] = ['success', $book->title.' '."books update Successfully"];
        return redirect()->back()->withNotify($notify);
        
    }

    // -----------------------------Manual all books request-----------------------------

    public function book_history()
    {
        $bookHistory = BookTransaction::where('author_book_id', Auth::guard('general')->user()->id)->where('status', '!=', 0)->orderBy('id','desc')->paginate(8);
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.manual_book_request.book_history', compact('bookHistory','priceCurrency'));
    }

    public function user_manual_book_request_view($id)
    {
        $book_request_view = BookTransaction::where('id', $id)->with('user','book')->first();
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.manual_book_request.book_view', compact('book_request_view','priceCurrency'));
    }

    public function read($id)
    {
        $buyBooks = Book::where('id', $id)->first();
        return response()->file("core/storage/app/public/books/" . $buyBooks->file);
    }

}
