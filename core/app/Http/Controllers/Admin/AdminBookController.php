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
        // dd($modalList);
        $data['general_books'] = Book::with(['category', 'priceCurrency'])->where('author_book_type','App\Models\User')->orderBy('id','desc')->paginate(10);
        $data['general_count'] = Book::where('author_book_id', Auth::guard('general')->id())->count();
        $data['categories'] = AdminCategory::all();
        $data['price'] = PriceCurrency::first();
        return view('admin.books.book', $data);
    }
    public function storeBook(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'file' => 'required|mimes:pdf|max:100000',
        ]);
        try {
            $book = new Book();
            $book->author_book_id = Auth::user()->id;
            $book->author_book_type = get_class(Auth::user());
            $book->title = $request->title;
            $book->description = $request->description;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->status = 1;
            $book->price = $request->price;
            $book->tag = $request->tag;
            $book->image = Generals::upload('books/', 'png', $request->image);
            $book->file = Generals::fileUpload('books/', $request->file);
            $book->save();
            $notify[] = ['success', 'Book create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editBook($id)
    {
        $book = Book::with(['category', 'priceCurrency'])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
        $categories = AdminCategory::all();
        $price = PriceCurrency::first();
        return view('admin.books.edit_book', compact('book', 'categories', 'price'));
    }

    public function editStatusBook(Request $request, $id)
    {
        $books = Book::where('id', $id)->first();
        if ($request->status == 'on') {
            $books-> status = 1;
            $books->update();
            $notify[] = ['success', 'Book Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $books->status = 0;
            $books->update();
            $notify[] = ['success', 'Book Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateBook(Request $request, $id)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'price' => 'required',
            'file' => 'mimes:pdf|max:100000',
        ]);
        try {
            $book = Book::where('id', $id)->first();
            $oldImage = $book->image;
            $oldFile = $book->file;
            $book->author_book_id = Auth::user()->id;
            $book->author_book_type = get_class(Auth::user());
            $book->title = $request->title;
            $book->category_id = $request->category;
            $book->price_id = $request->price_id;
            $book->price = $request->price;
            $book->status = 1;
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

            $notify[] = ['success', 'Book update Successfully'];
            return redirect()->route("book.index")->withNotify($notify);
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
        $notify[] = ['success', 'Book create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function allBooks()
    {
        $data['general_books'] = Book::with(['category', 'priceCurrency','user','admin.adminuser'])->orderby('id','desc')->paginate(8);
        $data['general_count'] = Book::count();
        $data['categories'] = AdminCategory::all();
        $data['price'] = PriceCurrency::first();
        return view('admin.books.all_books', $data);
    }

    public function viewBook($id)
    {
        // dd('ok');
        $book = Book::with(['category', 'priceCurrency'])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
        $categories = AdminCategory::all();
        $price = PriceCurrency::first();
        return view('admin.books.view_book', compact('book', 'categories', 'price'));
    }

    public function read($id)
    {
        $buyBooks = Book::where('id', $id)->first();
        return response()->file("core/storage/app/public/books/" . $buyBooks->file);
    }

}
