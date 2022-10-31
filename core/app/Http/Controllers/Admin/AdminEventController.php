<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\GeneralUser;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;

use function GuzzleHttp\Promise\all;

class AdminEventController extends Controller
{
   public function index()
   {
      $events = Event::with('user')->paginate(10);
      $general_user = GeneralUser::all();
      return view('admin.all-events.index', compact('events', 'general_user'));
   }
   public function editStatusEvent(Request $request, $id)
   {
      $events = Event::where('id', $id)->first();
      if ($request->status == 'on') {
         $events->status = 1;
         $events->update();
         $notify[] = ['success', 'Event is Active'];
        return redirect()->back()->withNotify($notify);
      } else {
         $events->status = 0;
         $events->update();
         $notify[] = ['success', 'Event is Inactive'];
        return redirect()->back()->withNotify($notify);
        
      }
   }
   public function destroy($id)
    {
        $event = Event::find($id);
        Generals::unlink('events/', $event->image);
        $event->delete();
        $notify[] = ['success', 'Events Delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
