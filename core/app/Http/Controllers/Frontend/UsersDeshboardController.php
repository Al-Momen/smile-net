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

class UsersDeshboardController extends Controller
{
    public function index()
    {
        $ticketTypePlans = TicketTypeDetails::with(['ticket_type'])->where('user_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->count();

        $eventPlanTranactionTicketCount = EventPlanTransaction::with(['eventPlans.ticketType'])->where('author_event_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->count();

        $eventPlanTranaction = EventPlanTransaction::with(['eventPlans.ticketType'])->where('author_event_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->paginate(5, ['*'], 'eventPlanTranaction');

        $books = BookTransaction::where('buy_user_id', Auth::guard('general')->id())->where('author_book_type', 'App\Models\GeneralUser')->orderBy('id', 'desc')->paginate(5, ['*'], 'books');

        $user_wallet = UserWallet::where('user_id', Auth::guard('general')->id())->first();

        $priceCurrency = PriceCurrency::first();

        $today = Carbon::now();
        $standard = TicketTypeDetails::where('ticket_slug', 'standard')->where('user_id', Auth::guard('general')->user()->id)->first();
        $premium = TicketTypeDetails::where('ticket_slug', 'premium')->where('user_id', Auth::guard('general')->user()->id)->first();
        
        if ($premium != null) {

            if ($premium->created_at->diffInDays($today, false) >= 30) {
                $premium->delete();
            }
        }
        if ($standard != null) {

            if ($standard->created_at->diffInDays($today, false) >= 30) {
                $standard->delete();
            }
        }

        return view('frontend.deshboard.pages.index', compact('eventPlanTranactionTicketCount', 'eventPlanTranaction', 'books', 'user_wallet', 'priceCurrency', 'ticketTypePlans','premium'));
    }
    public function placeOrder($id)
    {
        $book = Book::with(['category', 'priceCurrency', 'user', 'admin'])->findOrFail($id);
        $allGetways['paypal'] = AdminPaypalGetway::first();
        $allGetways['stripe'] = AdminStripeGetway::first();
        $allGetways['manual'] = AdminBuyManualGetway::where('status' ,1)->get();
        return view('frontend.pages.place_order', compact('book','allGetways'));
    }

    // ---------------------------------------- ticketType Pricing Place Order----------------------------------------
    public function ticketTypePricingPlaceOrder($id)
    {
        $ticketTypePricing = TicketType::with(['priceCurrency'])->findOrFail($id);
        return view('frontend.pages.ticket_type_pricing_place_order', compact('ticketTypePricing'));
    }

    // --------------------------------------- plan Pricing place order page---------------------------------------
    public function eventPlanTransaction($id)
    {
        $eventPlan = EventPlan::where('id', $id)->with(['ticketType', 'event.priceCurrency'])->first();
        return view('frontend.pages.event_plan_transaction', compact('eventPlan'));
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
            return back()->with('success', 'You are Already voted this item');
        }
        $voted = new UserVote();
        $voted->user_id = Auth::guard('general')->user()->id;
        $voted->admin_vote_id = $request->admin_vote_id;
        $voted->admin_vote_image_id = $request->voted;
        $voted->voted = 'yes';
        $voted->save();
        $notify[] = ['success', 'Vote Successfully'];
        return redirect()->back()->with('success', 'You Vote successfully');
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
        
        $buyBooks = BookTransaction::with('book')->where('buy_user_id', Auth::guard('general')->user()->id)->get();
        return view('frontend.deshboard.pages.buying_books', compact('buyBooks'));
    }

    public function buyingEventTicket()
    {
        $eventPlanTranaction = EventPlanTransaction::with(['eventPlans.ticketType'])->where('author_event_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.buying_ticket', compact('eventPlanTranaction', 'priceCurrency'));
    }
    public function buyingPlanTicket()
    {
        $ticketTypePlans = TicketTypeDetails::with(['ticket_type'])->where('user_id', Auth::guard('general')->user()->id)->orderBy('id', 'desc')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.buying_plan', compact('ticketTypePlans', 'priceCurrency'));
    }

    public function openPDF($id)
    {
        $buyBooks = Book::where('id', $id)->first();
        return response()->file("core\storage\app\public\books\\" . $buyBooks->file);
    }

}
