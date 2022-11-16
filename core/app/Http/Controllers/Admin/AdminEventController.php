<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPlan;
use App\Models\TicketType;
use App\Models\GeneralUser;
use Illuminate\Http\Request;

use App\Models\AdminCategory;
use App\Models\PriceCurrency;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\all;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

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
   public function editEvent($id)
   {
       $event = Event::with(['eventPlans',"eventPlans.ticketType"])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
       $categories = AdminCategory::all();
       $ticketType= TicketType::all();
       $priceCurrency = PriceCurrency::first();
       return view('admin.all-events.edit_event', compact('event', 'categories','ticketType','priceCurrency'));
   }
   public function updateEvents(Request $request, $id)
   { 
       $request->validate([
           'title' => 'required|min:2|max:255',
           'description' => 'required',
           'start_date' => 'required',
           'end_date' => 'required',
           'image' => 'required|image|mimes:jpeg,png,jpg',
           'category' => 'required',
           'ticket_type_id' => 'required',
       ]);
         
       try {
           $event = Event::findOrFail($id);
           $oldImage = $event->image;
           $event->author_event_id = Auth::guard('general')->user()->id;
           $event->price_currency_id = $request->price_currency_id;
           $event->title = $request->title;
           $event->description = $request->description;
           $event->start_date = $request->start_date;
           $event->end_date = $request->end_date;
           $event->category_id = $request->category;
           $event->image = Generals::update('events/', $oldImage, 'png', $request->image);
           $event->update();

           $ticketTypeIds = $request->ticket_type_id;
           $ticketSeats = $request->seat;
           $ticketPrices = $request->price;
           $oldTicketTypeIds = $event->eventPlans->pluck('ticket_type_id')->toArray();
           // first delete the which not exist in request
           foreach ($oldTicketTypeIds as $oldTicketTypeId) {
               if (!in_array($oldTicketTypeId, $ticketTypeIds)) {
                   EventPlan::where('event_id', $event->id)->where('ticket_type_id',$oldTicketTypeId)->first()->delete();
               }
           }
           foreach ($ticketSeats as $index => $seat) {          
               if (!is_null($seat)) {
                   $eventPlan = EventPlan::updateOrCreate(
                       [
                           'event_id'=>$event->id,
                           'ticket_type_id' => $ticketTypeIds[$index],
                       ],
                       [
                           'seat'=>$seat,
                           'price'=>$ticketPrices[$index],
                       ]
                   );     
               }
           }
           $notify[] = ['success', 'Events update Successfully'];
           return redirect()->route("user.events")->withNotify($notify);
       } catch (QueryException $e) {
           dd($e->getMessage());
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
