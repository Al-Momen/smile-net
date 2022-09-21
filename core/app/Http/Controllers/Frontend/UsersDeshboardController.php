<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersDeshboardController extends Controller
{
    public function index(){
       
        return view('frontend.deshboard.pages.index');
    }
    public function ticket(){
        return view('frontend.deshboard.pages.ticket');
    }
    public function book(){
        return view('frontend.deshboard.pages.book');
    }
    public function news(){
        return view('frontend.deshboard.pages.news');
    }
    public function placeOrder(){
        return view('frontend.pages.place_order');
    }
    public function voteDetails(){
        return view('frontend.pages.vote_details');
    }
}
