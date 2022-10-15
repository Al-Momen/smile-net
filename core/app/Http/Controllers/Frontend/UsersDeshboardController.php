<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\News;
use App\Models\Event;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminVote;
use App\Models\AdminVoteImage;
use App\Models\GeneralUserVote;
use App\Models\UserVote;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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
    public function voteDetails($id)
    {
        $adminVote = AdminVote::with(['adminVoteImages', 'adminVoteImages.userVotes'])->findOrFail($id);
        $totalVote = UserVote::where('admin_vote_id',$id)->where('voted','yes')->count();
        return view('frontend.pages.vote_details', compact('adminVote','totalVote'));
    }
    public function UserStoreVoted(Request $request)
    {
        $request->validate([
            'voted' => 'required',
        ]);
        $user_already_voted = UserVote::where('admin_vote_id',$request->admin_vote_id)->where('user_id',Auth::guard('general')->user()->id)->get();
        if($user_already_voted->count() > 0) {
            return back()->with('success','You are Already voted this item');
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
}
