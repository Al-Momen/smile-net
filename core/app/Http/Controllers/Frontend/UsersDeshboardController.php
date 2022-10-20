<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\News;
use App\Models\Event;
use App\Models\Coupon;
use App\Models\UserVote;
use App\Models\AdminVote;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Models\AdminVoteImage;
use App\Models\GeneralUserVote;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class UsersDeshboardController extends Controller
{
    public function index()
    {
        return view('frontend.deshboard.pages.index');
    }
    public function placeOrder($id)
    {
        $book = Book::with(['category', 'priceCurrency', 'user', 'admin'])->findOrFail($id);
        return view('frontend.pages.place_order', compact('book'));
    }

    // ---------------User coupon check---------------
    public function UserCouponCheck(Request $request)
    {
        if ($request->coupon_check) {
            $couponCheck = Coupon::where('code', $request->coupon_check)->first();
            if($couponCheck == null){
                return response()->json([
                    'error' => "Coupon code isn't Valid",
                ]);
            };
            if ($couponCheck->status == 1) {
                return response()->json([
                    'success' => 'Coupon code is successfully added',
                    'data' => $couponCheck
                ]);
            } 
            else {
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
}
