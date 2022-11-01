<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Plan;
use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use Illuminate\Http\Response;
use App\Http\Helpers\Generals;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PriceCurrency;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class EventController extends Controller
{
    public function events()
    {
        $data['general_events'] = Event::with(['category'])->where('user_id', Auth::guard('general')->id())->paginate(8);
        // --------------total events count--------------
        $data['general_count'] = Event::where('user_id', Auth::guard('general')->id())->count();
        // --------------active events count--------------
        $data['general_active_count'] = Event::where('user_id', Auth::guard('general')->id())->where('status',1)->count();

        // --------------pending events count--------------
        $data['general_pending_count'] = Event::where('user_id', Auth::guard('general')->id())->where('status',0)->count();

        $data['categories'] = AdminCategory::all();
        $data['ticketType'] = TicketType::all();
        $data['priceCurrency'] = PriceCurrency::first();
        return view('frontend.deshboard.pages.event', $data);
    }
    public function storeEvents(Request $request)
    {
       
        // $ticketId = $request->ticket_type_id;
        //     dd($ticketId);
        // dd($request->all());
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
            $event = new Event();
            $event->user_id = Auth::guard('general')->user()->id;
            $event->price_currency_id = $request->price_currency_id;
            $event->title = $request->title;
            $event->description = $request->description;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->category_id = $request->category;
            $event->image = Generals::upload('events/', 'png', $request->image);
            $event->save();
            $ticketTypeIds = $request->ticket_type_id;
            $ticketSeats = $request->seat;
            $ticketPrices = $request->price;
            foreach ($ticketTypeIds as $index => $ticketTypeId) {
                if (!is_null($ticketTypeId)) {
                    $plan = new Plan();
                    $plan->event_id = $event->id;
                    $plan->ticket_type_id = $ticketTypeId;
                    $plan->seat = $ticketSeats[$index];
                    $plan->price = $ticketPrices[$index];
                    $plan->save();
                }
            }
            $notify[] = ['success', 'Events create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editEvents($id)
    {
        $event = Event::with(['plans',"plans.ticketType"])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
        $categories = AdminCategory::all();
        $ticketType= TicketType::all();
        $priceCurrency = PriceCurrency::first();
        return view('frontend.deshboard.pages.edit_event', compact('event', 'categories','ticketType','priceCurrency'));
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
          return $request->all();
        try {
            $event = Event::findOrFail($id);
            $oldImage = $event->image;
            $event->user_id = Auth::guard('general')->user()->id;
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
            $oldTicketTypeIds = $event->plans->pluck('ticket_type_id')->toArray();
            // first delete the which not exist in request
            foreach ($oldTicketTypeIds as $oldTicketTypeId) {
                if (!in_array($oldTicketTypeId, $ticketTypeIds)) {
                    Plan::where('event_id', $event->id)->where('ticket_type_id',$oldTicketTypeId)->first()->delete();
                }
            }
            foreach ($ticketSeats as $index => $seat) {          
                if (!is_null($seat)) {
                    $plan = Plan::updateOrCreate(
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
        $event->plans()->delete();
        $event->delete();
        $notify[] = ['success', 'Events delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
