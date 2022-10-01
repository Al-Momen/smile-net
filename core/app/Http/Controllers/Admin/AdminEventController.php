<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\GeneralUser;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class AdminEventController extends Controller
{
    public function index()
    {
         $events=Event::all();
         $general_user=GeneralUser::all();
        return view('admin.all-events.index',compact('events','general_user'));
    }
    public function editStatusEvent(Request $request ,$id)
    {
         $events=Event::where('id',$id)->first();
         if ($request->status== 'on') {
            $events->status = 1;
            $events->update();
            return redirect()->back()->with('success','Event is Active');
         }
         else{
            $events->status = 0;
            $events->update();
            return redirect()->back()->with('danger','Event is Inactive');
         }
         
        
    }
}
