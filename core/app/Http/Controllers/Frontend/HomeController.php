<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('frontend.pages.voting');
    }

    public function magazine()
    {
        return view('frontend.pages.magazine');
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

}
