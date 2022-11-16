<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\Plan;
use App\Models\Event;
use App\Models\Music;
use App\Models\Frontend;
use App\Models\AdminNews;
use App\Models\AdminVote;
use App\Models\EventPlan;
use App\Models\TicketType;
use App\Models\AdminLiveTv;
use App\Models\GeneralUser;
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
use App\Models\BookTransaction;
use App\Models\AdminNewsComment;
use App\Models\AdminNewsDetails;
use App\Models\AdminSmileTvLike;
use App\Models\TicketTypeDetails;
use App\Models\AdminLiveTvComment;
use App\Models\AdminNewItemMovies;
use Illuminate\Support\Facades\DB;
use App\Models\AdminSmileTvComment;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AdminCommingSoonMovies;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\AdminMoviesController;
use App\Models\AdminVideoMusic;

class HomeController extends Controller
{
    // ---------------------------------------Home page---------------------------------------
    public function index()
    {

        $all_newItemMovies = AdminNewItemMovies::with('ticketType')->where('status', 1)->latest()->take(10)->get();
        $all_topMovies = AdminTopMovies::with('ticketType')->where('status', 1)->latest()->take(10)->get();
        $all_commingSoonMoviesLatest = AdminCommingSoonMovies::with('ticketType')->where('status', 1)->latest()->take(2)->get();
        $all_commingSoonMovies = AdminCommingSoonMovies::with('ticketType')->where('status', 1)->latest()->get();


        // --------------------site image--------------------
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'home');
        })->get();

        return view('frontend.pages.index', compact('all_newItemMovies', 'all_topMovies', 'all_commingSoonMoviesLatest', 'all_commingSoonMovies', 'site_image'));
    }

    // ---------------------------------------All top movies---------------------------------------
    public function allTopMovies()
    {

        $all_topMovies = AdminTopMovies::with('ticketType')->where('status', 1)->orderBy('id', 'desc')->paginate(16);
        return view('frontend.pages.all_top_movies', compact('all_topMovies'));
    }

    // ---------------------------------------top movies play---------------------------------------
    public function topMoviesPlay($id)
    {
        if (!Auth::guard('general')->user()) {
            return redirect()->route('login');
        };
        $playMovies = AdminTopMovies::with('ticketType')->where('id', $id)->first();
        $ticketTypePricing = TicketTypeDetails::where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->get();
        if ($ticketTypePricing->count() > 0) {
            return view('frontend.pages.play_video', compact('playMovies'));
        }
        return redirect()->route('ticketTypePricing')->with('success', 'Please upgrade your ticket');
    }
    // ---------------------------------------Item movies play---------------------------------------
    public function itemMoviesPlay($id)
    {
        
        if (!Auth::guard('general')->user()) {
            return redirect()->route('login');
        };
        $playMovies = AdminNewItemMovies::with('ticketType')->where('id', $id)->first();
        $ticketTypePricing = TicketTypeDetails::where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->get();
        if ($ticketTypePricing->count() > 0) {
            return view('frontend.pages.play_video', compact('playMovies'));
        }
        return redirect()->route('ticketTypePricing')->with('success', 'Please upgrade your ticket');


        // ---------------------------------------Comming Soon movies play---------------------------------------
    }
    public function commingSoonMoviesPlay($id)
    {
        if (!Auth::guard('general')->user()) {
            return redirect()->route('login');
        };
        $playMovies = AdminCommingSoonMovies::with('ticketType')->where('id', $id)->first();
        $ticketTypePricing = TicketTypeDetails::where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->get();
        if ($ticketTypePricing->count() > 0) {
            return view('frontend.pages.play_video', compact('playMovies'));
        }
        return redirect()->route('ticketTypePricing')->with('success', 'Please upgrade your ticket');
    }
    // ---------------------------------------Pricing page---------------------------------------
    public function ticketTypePricing()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'pricing');
        })->latest()->first();
        $allTicketType = TicketType::with(['priceCurrency'])->get();
        return view('frontend.pages.ticket_type_pricing', compact('allTicketType', 'site_image'));
    }

    // --------------------------------------- plan Pricing page---------------------------------------
    public function eventPlanPricing($id)
    {
        $eventPlan = EventPlan::where('id', $id)->with(['ticketType', 'event.priceCurrency'])->first();
        return view('frontend.pages.event_plan_pricing', compact('eventPlan'));
    }


    // ---------------------------------------Voting page---------------------------------------
    public function voting()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'voting');
        })->latest()->first();

        $categories = AdminCategory::with(['votes', 'votes.ticket', 'votes.adminVoteImages'])->get();
        return view('frontend.pages.voting', compact('categories', 'site_image'));
    }
    // ---------------------------------------Books page---------------------------------------
    public function books()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine');
        })->latest()->first();

        $books = Book::with(['category', 'priceCurrency', 'user', 'admin.adminUser', 'BookTransaction'])->orderBy('id', 'DESC')->take(20)->get();
        $popularBooks = BookTransaction::with('book')->groupBy('book_id')->selectRaw('count(*) as sold, book_id')->take(20)->get();

        return view('frontend.pages.book', compact('books', 'popularBooks', 'site_image'));
    }
    // ---------------------------------------book Transaction page---------------------------------------
    public function bookTransaction($id)
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine-details');
        })->latest()->first();

        $book = Book::with(['category', 'priceCurrency', 'user', 'admin', 'bookTransaction'])->findOrFail($id);
        return view('frontend.pages.book_details', compact('book', 'site_image'));
    }
    // ---------------------------------------book User Profile page---------------------------------------
    public function bookUserProfile($id)
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine-details');
        })->latest()->first();

        $bookprofile = Book::with(['user'])->where('author_book_id', $id)->where('author_book_type', "App\Models\GeneralUser")->first();
        return view('frontend.pages.book_user_profile', compact('bookprofile', 'site_image'));
    }
    // ---------------------------------------book Admin profile page---------------------------------------
    public function bookAdminProfile($id)
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'magazine-details');
        })->latest()->first();

        $bookprofile = Book::with(['admin.adminUser'])->where('author_book_id', $id)->where('author_book_type', 'App\Models\User')->first();

        return view('frontend.pages.book_admin_profile', compact('bookprofile', 'site_image'));
    }


    // ---------------------------------------Live now page---------------------------------------
    public function live_now()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'live-now');
        })->latest()->first();
        $liveTvs = AdminLiveTv::where('status', 1)->paginate(8);
        return view('frontend.pages.live_now', compact('liveTvs', 'site_image'));
    }
    // ---------------------------------------Live now details page---------------------------------------
    public function live_now_details($id)
    {
        $liveTvDetails = AdminLiveTv::findOrFail($id);
        $liveTvComments = AdminLiveTvComment::with('user')->where('live_tv_id', $id)->get();
        $totalLike = AdminLiveTvLike::with('user')->where('live_tv_id', $id)->where('like', '=', 'true')->count();
        $totalDisLike = AdminLiveTvLike::with('user')->where('live_tv_id', $id)->where('dislike', '=', 'true')->count();
        return view('frontend.pages.live_tv_details', compact('liveTvDetails', 'liveTvComments', 'totalLike', 'totalDisLike'));
    }
    // ---------------------------------------music page---------------------------------------
    public function music()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'music');
        })->latest()->first();

        $allMusic = Music::with('admin.adminUser')->orderBy('id', 'DESC')->paginate(10);
        $allMusicVideo = AdminVideoMusic::with('admin.adminUser')->where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        return view('frontend.pages.music', compact('allMusicVideo', 'allMusic', 'site_image'));
    }

    //  ---------------------------------------video music play---------------------------------------
    public function videoMusicPlay($id)
    {
        $playVideoMusic = AdminVideoMusic::where('id', $id)->first();
        return view('frontend.pages.play_video_music', compact('playVideoMusic'));
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
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'smile-tv');
        })->latest()->first();
        $allSmileTvs = AdminSmileTv::where('status', 1)->get();
        return view('frontend.pages.smile_tv', compact('allSmileTvs', 'site_image'));
    }


    // ---------------------------------------News page---------------------------------------
    public function news()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'news');
        })->latest()->first();
        $allNews = AdminNews::with(['admin', 'user'])->where('status', '=', 1)->paginate(6);
        return view('frontend.pages.news', compact('allNews', 'site_image'));
    }
    // ---------------------------------------News Details page---------------------------------------
    public function newsDetails($id)
    {
        $news = AdminNews::with('admin')->findOrFail($id);
        $newsComments = AdminNewsComment::with('user')->where('news_id', $id)->paginate(10);
        $totalLike = AdminNewsLike::with('user')->where('news_id', $id)->where('like', '=', 'true')->count();
        return view('frontend.pages.news_details', compact('news', 'newsComments', 'totalLike'));
    }
    // ---------------------------------------Place order page---------------------------------------
    public function placeOrder()
    {
        return view('frontend.pages.place_order');
    }
    // ---------------------------------------Event page---------------------------------------
    public function event()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'events');
        })->latest()->first();
        $events = Event::where('status', 1)->get();
        return view('frontend.pages.event', compact('events', 'site_image'));
    }
    // ---------------------------------------Event page---------------------------------------
    public function eventList($name)
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'events');
        })->latest()->first();
        $categoryData = AdminCategory::where('name', $name)->first();
        $events = AdminCategory::with('events.eventPlans')->where('id', $categoryData->id)->get();
        return view('frontend.pages.event', compact('events', 'site_image'));
    }
    // ---------------------------------------Plan page---------------------------------------
    public function eventAllPlans($id)
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'plan');
        })->latest()->first();
        $events = Event::with(['eventPlans', "eventPlans.ticketType"])->findOrFail($id);
        return view('frontend.pages.events_plans', compact('events', 'site_image'));;
    }
}
