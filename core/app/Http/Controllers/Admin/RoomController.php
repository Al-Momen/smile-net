<?php

namespace App\Http\Controllers\Admin;

use App\Models\MyRoom;
use App\Models\JoiningRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{
    public function join(Request $request){
        
        $room = $request->meeting_code;
        $user_id = auth('general')->user()->id;
        $join = new JoiningRoom();
        if ($user_id){
            $join->user_id = $user_id;
            $join->room_code = $room;
            $join->save();
        }else{
            $join->room_code = $room;
            $join->save();
        }

        return Redirect::route('admin.room',['room_name'=>$room]);
    }

    public function room($room_name){
        // dd($room_name);
        $myroom = new MyRoom();
        $user_id = auth('general')->user()->id;

        if ($user_id){
            $myroom->creator_id = $user_id;
            $myroom->room_code = $room_name;
            $myroom->save();
        }else{
            $myroom->room_code = $room_name;
            $myroom->save();
        }
        return view('admin.Meeting.meeting',[
            'room_name'=>$room_name
        ]);
    }
}
