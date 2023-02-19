<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\FAQ;
use App\Models\Book;
use App\Models\News;
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
use App\Models\AdminVideoMusic;
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
use PhpParser\PrettyPrinter\Standard;
use App\Models\AdminCommingSoonMovies;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Admin\AdminMoviesController;

class HomeController extends Controller
{
    // ---------------------------------------Home page---------------------------------------
    public function index()
    {
        // $general_user = Auth::guard('general')->user()->id;

        $all_newItemMovies = AdminNewItemMovies::with('ticketType')->where('status', 1)->latest()->take(10)->get();
        $all_topMovies = AdminTopMovies::with('ticketType')->where('status', 1)->latest()->take(10)->get();
        $all_commingSoonMoviesLatest = AdminCommingSoonMovies::with('ticketType')->where('status', 1)->latest()->take(2)->get();
        $all_commingSoonMovies = AdminCommingSoonMovies::with('ticketType')->where('status', 1)->latest()->get();

        // --------------------site image--------------------
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'home');
        })->get();


        if (Auth::guard('general')->user()) {
            $access = TicketTypeDetails::with('ticket_type')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
            if ($access != null) {
                if ($access->ticket_slug == 'standard' && $access->access == null) {
                    // dd($access);
                    return view('frontend.pages.index', compact('all_newItemMovies', 'all_topMovies', 'all_commingSoonMoviesLatest', 'all_commingSoonMovies', 'site_image', 'access'));
                }
            }
        }

        return view('frontend.pages.index', compact('all_newItemMovies', 'all_topMovies', 'all_commingSoonMoviesLatest', 'all_commingSoonMovies', 'site_image'));
    }

    //------------------------access Standard Package movies/ music------------------------
    public function userPackageAccess(Request $request)
    {
        $request->validate([
            'access' => 'required',
        ]);

        try {
            // dd('request');
            $access = TicketTypeDetails::with('ticket_type')->where('user_id', $request->user_id)->where('status', 1)->where('ticket_status', 1)->first();
            $access->access = $request->access;
            $access->update();
            return redirect()->back();
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
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
        if (Auth::guard('general')->user()) {
            $playMovies = AdminTopMovies::with('ticketType')->where('id', $id)->first();

            $findTicket = TicketTypeDetails::with('ticket_type')->where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();

            $premium = TicketTypeDetails::with('ticket_type')->where('user_id', Auth::guard('general')->user()->id)->where('ticket_slug', 'premium')->where('status', 1)->where('ticket_status', 1)->first();

            if ($playMovies->ticketType->name == "basic") {

                return view('frontend.pages.play_video', compact('playMovies'));
            } else if ($findTicket != null) {
                if ($findTicket->ticket_slug == 'standard' && $findTicket->access == 'movies' || $premium != null) {
                    return view('frontend.pages.play_video', compact('playMovies'));
                }
                $notify[] = ['success', 'You can see only music'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            } else if ($premium != null) {
                return view('frontend.pages.play_video', compact('playMovies'));
            } else {
                $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            }
        } else {
            return redirect()->route('login');
        }
    }
    // ---------------------------------------Item movies play---------------------------------------
    public function itemMoviesPlay($id)
    {
        // check login

        if (Auth::guard('general')->user()) {
            $playMovies = AdminNewItemMovies::with('ticketType')->where('id', $id)->first();

            $findTicket = TicketTypeDetails::with('ticket_type')->where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();

            $premium = TicketTypeDetails::with('ticket_type')->where('user_id', Auth::guard('general')->user()->id)->where('ticket_slug', 'premium')->where('status', 1)->where('ticket_status', 1)->first();

            if ($playMovies->ticketType->name == "basic") {

                return view('frontend.pages.play_video', compact('playMovies'));
            } else if ($findTicket != null) {
                if ($findTicket->ticket_slug == 'standard' && $findTicket->access == 'movies' || $premium) {

                    return view('frontend.pages.play_video', compact('playMovies'));
                }
                $notify[] = ['success', 'You can see only music'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            } else if ($premium != null) {
                return view('frontend.pages.play_video', compact('playMovies'));
            } else {
                $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            }
        } else {
            return redirect()->route('login');
        }
    }
    // ---------------------------------------Comming Soon movies play---------------------------------------
    public function commingSoonMoviesPlay($id)
    {
        if (Auth::guard('general')->user()) {
            $playMovies = AdminCommingSoonMovies::with('ticketType')->where('id', $id)->first();
            return view('frontend.pages.play_video', compact('playMovies'));
        } else {
            return redirect()->route('login');
        };
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
        // dd($bookprofile);
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
        $today = \Carbon\Carbon::now();
        if (Auth::guard('general')->user()) {
            $premium = TicketTypeDetails::where('ticket_slug', 'premium')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
            if ($premium != null) {
                $premium = Carbon::parse($premium->date);
                $today = Carbon::parse($today);
                $date_diff = $premium->diffInDays($today);
                if ($date_diff >= 0) {
                    $liveTvs = AdminLiveTv::where('status', 1)->paginate(8);
                    $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                        $query->where('pages', 'live-now');
                    })->latest()->first();
                    return view('frontend.pages.live_now', compact('liveTvs', 'site_image'));
                }
                $premium->ticket_status = 0;
                $premium->update();
            } else {
                $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            }
        } else {
            return redirect()->route('login');
        }
    }
    // ---------------------------------------Item movies play---------------------------------------
    public function liveTvPlay($id)
    {
        $playLiveVideo = AdminSmileTv::where('id', $id)->first();
        // $ticketTypePricing = TicketTypeDetails::where('ticket_type_id', $playMovies->ticket_type_id)->where('user_id', Auth::guard('general')->user()->id)->get();
        // if ($ticketTypePricing->count() > 0) {
        // }
        // dd($playLiveVideo);
        return view('frontend.pages.play_video_live', compact('playLiveVideo'));
        // return redirect()->route('ticketTypePricing')->with('success', 'Please upgrade your ticket');

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
        $today = Carbon::now();
        // check login
        if (Auth::guard('general')->user()) {
            $standard = TicketTypeDetails::where('ticket_slug', 'standard')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();

            $premium = TicketTypeDetails::where('ticket_slug', 'premium')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();

            //access standard
            $access = TicketTypeDetails::with('ticket_type')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
            if ($access != null) {
                if ($access->ticket_slug == 'standard' && $access->access == null) {
                    $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                        $query->where('pages', 'music');
                    })->latest()->first();
                    $allMusic = Music::with('admin.adminUser')->where('status',1)->orderBy('id', 'DESC')->paginate(12,['*'],'allMusic');
                    $allMusicVideo = AdminVideoMusic::with('admin.adminUser')->where('status', 1)->orderBy('id', 'DESC')->paginate(10,['*'],'allMusicVideo');
                    return view('frontend.pages.music', compact('allMusicVideo', 'allMusic', 'site_image', 'access'));
                }
            }

            // check standard package
            if ($standard != null) {
                // check monthly package expired
                $standard_date = Carbon::parse($standard->date);
                $today = Carbon::parse($today);
                $date_diff = $standard_date->diffInDays($today);
                if ($standard->access == 'music') {
                    if ($date_diff >= 0) {
                        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                            $query->where('pages', 'music');
                        })->latest()->first();
                        $allMusic = Music::with('admin.adminUser')->where('status',1)->orderBy('id', 'DESC')->paginate(12,['*'],'allMusic');
                        $allMusicVideo = AdminVideoMusic::with('admin.adminUser')->where('status', 1)->orderBy('id', 'DESC')->paginate(10,['*'],'allMusicVideo');
                        return view('frontend.pages.music', compact('allMusicVideo', 'allMusic', 'site_image'));
                    } else {
                        $standard->ticket_status = 0;
                        $standard->update();
                        $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                        return redirect()->route('ticketTypePricing')->withNotify($notify);
                    }
                } else {
                    $notify[] = ['success', 'You can see only Movies'];
                    return redirect()->route('ticketTypePricing')->withNotify($notify);
                }
                // check premium package
            } else if ($premium != null) {
                $premium_date = Carbon::parse($premium->date);
                $today = Carbon::parse($today);
                $date_diff = $premium_date->diffInDays($today);
                if ($date_diff >= 0) {
                    $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                        $query->where('pages', 'music');
                    })->latest()->first();
                    $allMusic = Music::with('admin.adminUser')->where('status',1)->orderBy('id', 'DESC')->paginate(12,['*'],'allMusic');
                    $allMusicVideo = AdminVideoMusic::with('admin.adminUser')->where('status', 1)->orderBy('id', 'DESC')->paginate(10,['*'],'allMusicVideo');
                    return view('frontend.pages.music', compact('allMusicVideo', 'allMusic', 'site_image'));
                } else {
                    $premium->ticket_status = 0;
                    $premium->update();
                    $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                    return redirect()->route('ticketTypePricing')->withNotify($notify);
                }
            } else {
                $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            }
        } else {
            return redirect()->route('login');
        }
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
        $latest_songs = Music::orderBy('id', 'DESC')->where('status',1)->take(20)->get();
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
        $today = Carbon::now();
        if (Auth::guard('general')->user()) {
            $standard = TicketTypeDetails::where('ticket_slug', 'standard')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
            $premium = TicketTypeDetails::where('ticket_slug', 'premium')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();

            if ($standard != null) {
                $standard_date = Carbon::parse($standard->date);
                $today = Carbon::parse($today);
                $date_diff = $standard_date->diffInDays($today);

                if ($date_diff >= 0) {
                    $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                        $query->where('pages', 'news');
                    })->latest()->first();
                    $allNews = AdminNews::with(['admin', 'user'])->where('status', '=', 1)->paginate(6);
                    return view('frontend.pages.news', compact('allNews', 'site_image'));
                } else {
                    $standard->ticket_status = 0;
                    $standard->update();
                    $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                    return redirect()->route('ticketTypePricing')->withNotify($notify);
                }
            } else if ($premium != null) {
                $premium_date = Carbon::parse($premium->date);
                $today = Carbon::parse($today);
                $date_diff = $premium_date->diffInDays($today);

                if ($date_diff >= 0) {
                    $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
                        $query->where('pages', 'news');
                    })->latest()->first();
                    $allNews = AdminNews::with(['admin', 'user'])->where('status', '=', 1)->paginate(6);
                    return view('frontend.pages.news', compact('allNews', 'site_image'));
                } else {
                    $premium->ticket_status = 0;
                    $premium->update();
                    $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                    return redirect()->route('ticketTypePricing')->withNotify($notify);
                }
            } else {
                $notify[] = ['success', 'Please upgrade your Subscription Plan'];
                return redirect()->route('ticketTypePricing')->withNotify($notify);
            }
        } else {
            return redirect()->route('login');
        }
    }
    // ---------------------------------------News Details page---------------------------------------
    public function newsDetails($id)
    {
        $news = AdminNews::with('admin')->findOrFail($id);
        $newsComments = AdminNewsComment::with('user')->where('news_id', $id)->paginate(10);
        $totalLike = AdminNewsLike::with('user')->where('news_id', $id)->where('like', '=', 'true')->count();
        return view('frontend.pages.news_details', compact('news', 'newsComments', 'totalLike'));
    }

     // ---------------------------------------news Admin profile page---------------------------------------
     public function newsAdminProfile($id)
     {
        
         $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
             $query->where('pages', 'magazine-details');
         })->latest()->first();
 
         $newsprofile = AdminNews::with(['admin.adminUser'])->where('id', $id)->where('news_type', 'App\Models\User')->first();
         $allNews = AdminNews::with('user')->where('user_id',$newsprofile->user_id)->where('news_type', 'App\Models\User')->paginate(12);
         return view('frontend.pages.news.news_admin_profile', compact(
            'newsprofile', 
            'site_image',
            'allNews'
        ));
     }

     public function newsUserProfile($id)
     {
         $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
             $query->where('pages', 'magazine-details');
         })->latest()->first();
 
         $newsprofile = AdminNews::with('user')->where('id', $id)->where('news_type', 'App\Models\GeneralUser')->first();
         $allNews = AdminNews::with('user')->where('user_id', $newsprofile->user_id)->where('news_type', 'App\Models\GeneralUser')->paginate(12);
        
         return view('frontend.pages.news.news_user_profile', compact(
            'newsprofile',
             'site_image',
             'allNews'
            ));
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

    // ---------------------------------------Plan page---------------------------------------
    public function faq()
    {
        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'faq');
        })->latest()->first();
        $allFaq = FAQ::all();
       
        return view('frontend.pages.faq.index', compact('site_image','allFaq'));
    }

    // ---------------------------------------Plan page---------------------------------------
    public function moviesSearch(Request $request)
    {
        // $request->validate([
        //     'data' => 'required',
        // ]);

        $site_image = AdminManageSite::where('status', 1)->whereHas('manageSite', function (Builder $query) {
            $query->where('pages', 'home');
        })->get();


        // return print_r($request->all());
        $data = [];
        $data['newItem'] = AdminNewItemMovies::where('status',1)->where('name','LIKE','%'.$request->data.'%')->get();
        $data['topItem'] = AdminTopMovies::where('status',1)->where('name','LIKE','%'.$request->data.'%')->get();
        $data['commingSoonItem'] = AdminCommingSoonMovies::where('status',1)->where('name','LIKE','%'.$request->data.'%')->get();

        if ($request->data != '') {
            return response()->json([
                'success' => 'new item found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }

    //  books search
    public function booksSearch(Request $request)
    {
        $data = Book::where('status',1)->where('title','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'Books found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }

    // news search
    public function newsSearch(Request $request)
    {
        $data = AdminNews::where('status',1)->where('title','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'News found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }

    // Smile-tv search
    public function SmileTvSearch(Request $request)
    {
        $data = AdminSmileTv::where('status',1)->where('mp4', '!=', null)->where('title','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'Smile-tv found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }
    // Music search
    public function musicsVideoSearch(Request $request)
    {
        $data = AdminVideoMusic::where('status',1)->where('title','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'Music video found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }
    // vote search
    public function voteSearch(Request $request)
    {
        $data = AdminVote::where('status',1)->where('vote_name','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'Vote found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }

    // Events search
    public function eventsSearch(Request $request)
    {
       
        $data = Event::where('status',1)->where('category_id',$request->category_id)->where('title','LIKE','%'.$request->data.'%')->get();
        if ($request->data != '') {
            return response()->json([
                'success' => 'event found successful',
                'data' => $data,
                'status' => 1,
            ]);
        } else {
            return response()->json([
                'success' => "No data found",
                'status' => 1,
            ]);
        };
    }
}
