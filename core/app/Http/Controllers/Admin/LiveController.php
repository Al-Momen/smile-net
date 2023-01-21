<?php

namespace App\Http\Controllers\Admin;

use App\Models\MyRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LiveController extends Controller
{
    public function join_meeting(){
        return view('admin.Meeting.meeting_join');
    }

    public function host_meeting(){
        return view('admin.Meeting.host_meeting');
    }

    public function meeting_history(){
        $meeting_history = MyRoom::orderBy('id', 'DESC')->paginate(14);
        return view('admin.Meeting.meeting_history',compact('meeting_history'));
    }
}
