<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Book;
use App\Models\Plan;
use App\Models\Event;
use App\Models\AdminVote;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Http\Controllers\Controller;
use App\Models\PriceCurrency;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.pages.index');
    }
    public function pricing()
    {
        return view('frontend.pages.pricing');
    }
    public function voting()
    {
        $categories=AdminCategory::with(['votes','votes.ticket','votes.adminVoteImages'])->get();
        return view('frontend.pages.voting',compact('categories'));
    }
    public function magazine(){   
        $books = Book::with(['category','priceCurrency','user','admin'])->orderBy('id','DESC')->take(20)->get();
        $price_symbol = PriceCurrency::first();
        return view('frontend.pages.magazine', compact('books','price_symbol'));
    }
    public function magazineDetails($id)
    {
        $book = Book::with(['category','priceCurrency','user','admin'])->findOrFail($id);  
        return view('frontend.pages.magazine_details',compact('book'));
    }
    public function live_now()
    {
        return view('frontend.pages.live_now');
    }
    public function music()
    {
        return view('frontend.pages.music');
    }
    public function smile_tv()
    {
        return view('frontend.pages.smile_tv');
    }
    public function news()
    {   
        return view('frontend.pages.news');
    }
    public function placeOrder(){
        return view('frontend.pages.place_order');
    }
    public function newsDetails(){
        return view('frontend.pages.news_details');
    }
    public function smileTv(){
        return view('frontend.pages.smile_tv');
    }
    public function event(){
        $events=Event::where('status',1)->get();
        return view('frontend.pages.event',compact('events'));
    }
    public function eventList($name){   
        $categoryData=AdminCategory::where('name', $name)->first();
        $events =AdminCategory::with('events.plans')->where('id',$categoryData->id)->get();
        return view('frontend.pages.event',compact('events'));
    }
    public function eventAllPlans($id)
    {
        $events =Event::with(['plans',"plans.ticket_type"])->findOrFail($id);
        return view('frontend.pages.plans',compact('events'));;
    }

    

}
