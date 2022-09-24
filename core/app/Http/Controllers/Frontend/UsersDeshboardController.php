<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\GeneralUser;
use App\Models\News;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Intervention\Image\Facades\Image;

class UsersDeshboardController extends Controller
{
    public function index()
    {

        return view('frontend.deshboard.pages.index');
    }
    public function ticket()
    {
        $general_tickets =Event::where('user_id',Auth::guard('general')->id())->get();
        return view('frontend.deshboard.pages.ticket',compact('general_tickets'));
    }
    public function book()
    {
        $general_books =Book::where('user_id',Auth::guard('general')->id())->get();
        return view('frontend.deshboard.pages.book',compact('general_books'));
    }
    public function news()
    {
        $general_news =News::where('user_id',Auth::guard('general')->id())->get();
        return view('frontend.deshboard.pages.news',compact('general_news'));
    }
    public function placeOrder()
    {
        return view('frontend.pages.place_order');
    }
    public function voteDetails()
    {
        return view('frontend.pages.vote_details');
    }
   
}
