<?php

namespace App\Http\Controllers\Frontend;

use App\Models\MyRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserMeetingController extends Controller
{
    public function join_meeting(){
        return view('frontend.deshboard.pages.Meeting.meeting_join');
    }

    public function host_meeting(){
        return view('frontend.deshboard.pages.Meeting.host_meeting');
    }

    public function meeting_history(){

        $meeting_history = MyRoom::where('creator_id',Auth::guard('general')->user()->id)->paginate(12);
        return view('frontend.deshboard.pages.Meeting.meeting_history',compact('meeting_history'));
    }
}
