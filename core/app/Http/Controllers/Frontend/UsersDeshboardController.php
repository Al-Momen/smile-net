<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\News;
use App\Models\Plan;
use App\Models\Event;
use App\Models\Coupon;
use App\Models\UserVote;
use App\Models\AdminVote;
use App\Models\EventPlan;
use Doctrine\DBAL\Events;
use App\Models\TicketType;
use App\Models\UserWallet;
use App\Models\GeneralUser;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\AdminVoteImage;
use App\Models\PricingDetails;
use App\Models\BookTransaction;
use App\Models\GatewayCurrency;
use App\Models\GeneralUserVote;
use App\Models\AdminPaypalGetway;
use App\Models\AdminStripeGetway;
use App\Models\TicketTypeDetails;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdminBuyManualGetway;
use App\Models\EventPlanTransaction;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\ManualGatewayController;
use Barryvdh\DomPDF\Facade\Pdf;

class UsersDeshboardController extends Controller
{
    public function index()
    {
        $ticketTypePlans = TicketTypeDetails::with(['ticket_type'])->where('user_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->count();
        $eventPlanTranactionTicketCount = EventPlanTransaction::with(['eventPlans.ticketType'])->where('author_event_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->count();

        $eventPlanTranaction = EventPlanTransaction::with(['eventPlans.ticketType'])->where('buy_user_id', Auth::guard('general')->user()->id)->where('status', 1)->orderBy('id', 'desc')->paginate(5, ['*'], 'eventPlanTranaction');

        $books = BookTransaction::where('buy_user_id', Auth::guard('general')->id())->where('author_book_type', 'App\Models\GeneralUser')->where('status', 1)->orderBy('id', 'desc')->paginate(5, ['*'], 'books');

        $user_wallet = UserWallet::where('user_id', Auth::guard('general')->id())->first();

        $priceCurrency = PriceCurrency::first();

        $today = Carbon::now();
        $standard = TicketTypeDetails::with('ticket_type')->where('ticket_slug', 'standard')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
        $premium = TicketTypeDetails::with('ticket_type')->where('ticket_slug', 'premium')->where('user_id', Auth::guard('general')->user()->id)->where('status', 1)->where('ticket_status', 1)->first();
        // dd($premium);


        if ($premium != null) {
            $premium_date = Carbon::parse($premium->date);
            $today = Carbon::parse($today);
            $date_diff = $premium_date->diffInDays($today);
            if ($date_diff <= 0) {
                // dd('ok');
                $premium->ticket_status = 0;
                $premium->update();
            }
        }
        if ($standard != null) {
            $standard_date = Carbon::parse($standard->date);
            $today = Carbon::parse($today);
            $date_diff = $standard_date->diffInDays($today);
            if ($date_diff <= 0) {
                $standard->ticket_status = 0;
                $standard->update();
            }
        }

        // ---------------------user wallet create---------------------
        $user_wallet = UserWallet::where('user_id', Auth::guard('general')->user()->id)->first();
        if (!$user_wallet) {
            $user_wallet = new UserWallet();
            $user_wallet->user_id = Auth::guard('general')->user()->id;
            $user_wallet->save();
        }
        $empty_message = 'No data found';

        return view('frontend.deshboard.pages.index', compact(
            'eventPlanTranactionTicketCount',
            'eventPlanTranaction',
            'books',
            'user_wallet',
            'priceCurrency',
            'ticketTypePlans',
            'premium',
            'empty_message',
        ));
    }
    public function placeOrder($id)
    {
        $book = Book::with(['category', 'priceCurrency', 'user', 'admin'])->findOrFail($id);
        $allGetways = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        return view('frontend.pages.place_order', compact('book', 'allGetways'));
    }

    // ---------------------------------------- ticketType Pricing Place Order----------------------------------------
    public function ticketTypePricingPlaceOrder($id)
    {
        $ticketTypePricing = TicketType::with(['priceCurrency'])->findOrFail($id);

        $allGetways = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        // dd($allGetways);
        return view('frontend.pages.ticket_type_pricing_place_order', compact('ticketTypePricing', 'allGetways'));
    }

    // --------------------------------------- plan Pricing place order page---------------------------------------
    public function eventPlanTransaction($id)
    {
        $eventPlan = EventPlan::where('id', $id)->with(['ticketType', 'event.priceCurrency'])->first();
        $allGetways = GatewayCurrency::whereHas('method', function ($gate) {
            $gate->where('status', 1);
        })->with('method')->orderby('method_code')->get();
        return view('frontend.pages.event_plan_transaction', compact('eventPlan', 'allGetways'));
    }

    // ---------------User coupon check by ajax---------------
    public function UserCouponCheck(Request $request)
    {
        if ($request->coupon_check) {
            $couponCheck = Coupon::where('code', $request->coupon_check)->first();
            if ($couponCheck == null) {
                return response()->json([
                    'error' => "Coupon code isn't Valid",
                ]);
            };

            if ($couponCheck->status == 1) {
                return response()->json([
                    'success' => 'Coupon code is successfully added',
                    'data' => $couponCheck
                ]);
            } else {
                return response()->json([
                    'error' => "Coupon code isn't Valid",
                ]);
            };
        }
    }

    public function voteDetails($id)
    {
        $adminVote = AdminVote::with(['adminVoteImages', 'adminVoteImages.userVotes'])->findOrFail($id);
        $totalVote = UserVote::where('admin_vote_id', $id)->where('voted', 'yes')->count();
        return view('frontend.pages.vote_details', compact('adminVote', 'totalVote'));
    }
    public function UserStoreVoted(Request $request)
    {
        $request->validate([
            'voted' => 'required',
        ]);
        $user_already_voted = UserVote::where('admin_vote_id', $request->admin_vote_id)->where('user_id', Auth::guard('general')->user()->id)->get();
        if ($user_already_voted->count() > 0) {
            $notify[] = ['success', 'You are Already voted this item'];
            return back()->withNotify($notify);
        }
        $voted = new UserVote();
        $voted->user_id = Auth::guard('general')->user()->id;
        $voted->admin_vote_id = $request->admin_vote_id;
        $voted->admin_vote_image_id = $request->voted;
        $voted->voted = 'yes';
        $voted->save();
        $notify[] = ['success', 'Vote Successfully'];
        return redirect()->back()->withNotify($notify);
    }
    public function userPayment(Request $request)
    {
        dd($request->all());
    }
    public function likeComment(Request $request)
    {
        dd($request->all());
    }

    public function buyingBooks()
    {
        $buyBooks = BookTransaction::with('book')->where('buy_user_id', Auth::guard('general')->user()->id)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
        $empty_message = 'No Data Found';
        return view('frontend.deshboard.pages.buying_books', compact('buyBooks', 'empty_message'));
    }
    public function buyingEventTicket()
    {
        $eventPlanTranaction = EventPlanTransaction::with(['eventPlans.ticketType'])->where('buy_user_id', Auth::guard('general')->user()->id)->where('status', 1)->orderBy('id', 'desc')->paginate(10);
        // dd($eventPlanTranaction);
        $priceCurrency = PriceCurrency::first();
        $empty_message = 'No Data Found';
        return view('frontend.deshboard.pages.buying_plan', compact(
            'eventPlanTranaction',
            'priceCurrency',
            'empty_message',
        ));
    }

    public function buyingEventTicketPDF($id)
    {
        $data = EventPlanTransaction::where('id',$id)->with(['eventPlans.ticketType','eventPlans.event','user'])->first();
        $priceCurrency = PriceCurrency::first();
        
        $data = [ 
            'data' => $data,
            'priceCurrency' => $priceCurrency,
        ];
        //   dd($data);
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('ticket.pdf');
    }

    public function buyingPlanTicket()
    {
        $ticketTypePlans = TicketTypeDetails::with(['ticket_type'])->where('user_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->where('status', '!=', 0)->paginate(10);
        // dd($ticketTypePlans);
        $empty_message = 'No Data Found';
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.buying_ticket', compact(
            'ticketTypePlans',
            'priceCurrency',
            'empty_message',
        ));
    }

    public function openPDF($id)
    {
        $buyBooks = Book::where('id', $id)->first();
        return response()->file("core/storage/app/public/books/" . $buyBooks->file);
    }

    // -----------------------------Manual all Ticket request-----------------------------
    public function ticket_history()
    {
        $ticketHistory = TicketTypeDetails::where('user_id', Auth::guard('general')->user()->id)->where('status', '!=', 0)->paginate(8);
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.manual_ticket_request.ticket_history', compact('ticketHistory', 'priceCurrency'));
    }

    public function user_manual_ticket_request_view($id)
    {
        $ticket_request_view = TicketTypeDetails::where('id', $id)->with('user', 'ticket_type')->first();
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.manual_ticket_request.ticket_view', compact('ticket_request_view', 'priceCurrency'));
    }
}
