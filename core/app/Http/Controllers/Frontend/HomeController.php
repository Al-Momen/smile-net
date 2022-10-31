<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Plan;
use App\Models\Event;
use App\Models\Music;
use App\Models\Frontend;
use App\Models\AdminNews;
use App\Models\AdminVote;
use App\Models\TicketType;
use App\Models\AdminLiveTv;
use App\Models\BookDetails;
use App\Models\AdminPricing;
use App\Models\AdminSmileTv;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Models\AdminNewsLike;
use App\Models\PriceCurrency;
use App\Models\AdminTopMovies;
use App\Models\AdminLiveTvLike;
use App\Models\AdminManageSite;
use App\Models\AdminVipPricing;
use App\Models\AdminNewsComment;
use App\Models\AdminNewsDetails;
use App\Models\AdminSmileTvLike;
use App\Models\AdminLiveTvComment;
use App\Models\AdminNewItemMovies;
use Illuminate\Support\Facades\DB;
use App\Models\AdminSmileTvComment;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use App\Models\AdminCommingSoonMovies;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Admin\AdminMoviesController;

class HomeController extends Controller
{
    // ---------------------------------------Home page---------------------------------------
    public function index()
    {

        $all_newItemMovies = AdminNewItemMovies::with('ticketType')->where('status',1)->latest()->take(10)->get();
        $all_topMovies= AdminTopMovies::with('ticketType')->where('status',1)->latest()->take(10)->get();
        $all_commingSoonMoviesLatest= AdminCommingSoonMovies::with('ticketType')->where('status',1)->latest()->take(2)->get();
        $all_commingSoonMovies= AdminCommingSoonMovies::with('ticketType')->where('status',1)->latest()->take(10)->get();
        
        // --------------------site image--------------------
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'home');
        })->get();

        return view('frontend.pages.index',compact('all_newItemMovies','all_topMovies','all_commingSoonMoviesLatest','all_commingSoonMovies','site_image'));
    }

    // ---------------------------------------All top movies---------------------------------------
    public function allTopMovies()
    {
   
        $all_topMovies= AdminTopMovies::with('ticketType')->where('status',1)->paginate(16);
        return view('frontend.pages.all_top_movies',compact('all_topMovies'));
    }

    // ---------------------------------------top movies play---------------------------------------
    public function moviesPlay($id)
    {
        $playMovies= AdminTopMovies::with('ticketType')->where('id',$id)->first();
        return view('frontend.pages.play_video',compact('playMovies'));
    }
    // ---------------------------------------Item movies play---------------------------------------
    public function itemMoviesPlay($id)
    {
        $playMovies= AdminNewItemMovies::with('ticketType')->where('id',$id)->first();
        return view('frontend.pages.play_video',compact('playMovies'));

         // ---------------------------------------Comming Soon movies play---------------------------------------
    }
    public function commingSoonMoviesPlay($id)
    {
        $playMovies= AdminCommingSoonMovies::with('ticketType')->where('id',$id)->first();
        return view('frontend.pages.play_video',compact('playMovies'));
    }
    // ---------------------------------------Pricing page---------------------------------------
    public function pricing()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'pricing');
        })->latest()->first();
        $allPricing = AdminPricing::with(['ticketType', 'priceCurrency', 'admin'])->where('status',1)->get();
        return view('frontend.pages.pricing',compact('allPricing','site_image'));
    }
   
    // --------------------------------------- plan Pricing page---------------------------------------
    public function planPricing($id)
    {
        $plan = Plan::where('id',$id)->with(['ticketType','event.priceCurrency'])->first();
        return view('frontend.pages.plan_pricing',compact('plan'));
    }

    
    // ---------------------------------------Voting page---------------------------------------
    public function voting()
    {   
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'voting');
        })->latest()->first();

        $categories = AdminCategory::with(['votes', 'votes.ticket', 'votes.adminVoteImages'])->get();
        return view('frontend.pages.voting', compact('categories','site_image'));
    }
    // ---------------------------------------Magazine page---------------------------------------
    public function magazine()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine');
        })->latest()->first();

        $books = Book::with(['category', 'priceCurrency', 'user', 'admin', 'bookDetails'])->orderBy('id', 'DESC')->take(20)->get();
        $popularBooks = BookDetails::with('book')->groupBy('book_id')->selectRaw('count(*) as sold, book_id')->take(20)->get();
        return view('frontend.pages.magazine', compact('books', 'popularBooks','site_image'));
    }
    // ---------------------------------------Magazine Details page---------------------------------------
    public function magazineDetails($id)
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine-details');
        })->latest()->first();

        $book = Book::with(['category', 'priceCurrency', 'user', 'admin'])->findOrFail($id);
        return view('frontend.pages.magazine_details', compact('book','site_image'));
    }
    // ---------------------------------------Live now page---------------------------------------
    public function live_now()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'live-now');
        })->latest()->first();
        $liveTvs = AdminLiveTv::where('status',1)->paginate(8);
        return view('frontend.pages.live_now',compact('liveTvs','site_image'));
    }
    // ---------------------------------------Live now details page---------------------------------------
    public function live_now_details($id)
    {
        $liveTvDetails = AdminLiveTv::findOrFail($id);
        $liveTvComments = AdminLiveTvComment::with('user')->where('live_tv_id',$id)->get();
        $totalLike = AdminLiveTvLike::with('user')->where('live_tv_id',$id)->where('like','=','true')->count();
        $totalDisLike = AdminLiveTvLike::with('user')->where('live_tv_id',$id)->where('dislike','=','true')->count();
        return view('frontend.pages.live_tv_details',compact('liveTvDetails','liveTvComments','totalLike','totalDisLike'));
    }
    // ---------------------------------------music page---------------------------------------
    public function music()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'music');
        })->latest()->first();

        $allMusic = Music::with('admin')->paginate(10);
        return view('frontend.pages.music', compact('allMusic','site_image'));
    }

    // --------------------------Ajax for the audio player use in music page---------------------------------------
    public function latestSongs()
    {
        $latest_songs = Music::orderBy('id', 'DESC')->take(20)->get();
        return response()->json($latest_songs);
    }
    
    // ---------------------------------------Smile TV page---------------------------------------
    public function smileTv()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'smile-tv');
        })->latest()->first();
        $allSmileTvs = AdminSmileTv::where('status',1)->get();
        return view('frontend.pages.smile_tv',compact('allSmileTvs','site_image'));
    }

   
    // ---------------------------------------News page---------------------------------------
    public function news()
    {   
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'news');
        })->latest()->first();
        $allNews = AdminNews::with('admin')->where('status', '=', 1)->paginate(6);
        return view('frontend.pages.news', compact('allNews','site_image'));
    }
    // ---------------------------------------News Details page---------------------------------------
    public function newsDetails($id)
    {
        $news = AdminNews::with('admin')->findOrFail($id);
        $newsComments = AdminNewsComment::with('user')->where('news_id',$id)->paginate(10);
        $totalLike = AdminNewsLike::with('user')->where('news_id',$id)->where('like','=','true')->count();
        return view('frontend.pages.news_details', compact('news','newsComments','totalLike'));
    }
    // ---------------------------------------Place order page---------------------------------------
    public function placeOrder()
    {
        return view('frontend.pages.place_order');
    }
    // ---------------------------------------Event page---------------------------------------
    public function event()
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'events');
        })->latest()->first();
        $events = Event::where('status', 1)->get();
        return view('frontend.pages.event', compact('events','site_image'));
    }
    // ---------------------------------------Event page---------------------------------------
    public function eventList($name)
    {
         $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'events');
        })->latest()->first();
        $categoryData = AdminCategory::where('name', $name)->first();
        $events = AdminCategory::with('events.plans')->where('id', $categoryData->id)->get();
        return view('frontend.pages.event', compact('events','site_image'));
    }
    // ---------------------------------------Plan page---------------------------------------
    public function eventAllPlans($id)
    {
        $site_image= AdminManageSite::where('status',1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'plan');
        })->latest()->first();
         $events = Event::with(['plans', "plans.ticketType"])->findOrFail($id);
        return view('frontend.pages.plans', compact('events','site_image'));;
    }
}
