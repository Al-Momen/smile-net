<?php

namespace App\Http\Controllers\Frontend;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\News;
use App\Models\Event;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class UsersDeshboardController extends Controller
{
    public function index()
    {

        return view('frontend.deshboard.pages.index');
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
