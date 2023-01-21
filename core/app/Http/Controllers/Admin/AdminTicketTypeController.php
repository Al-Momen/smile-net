<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;

use App\Models\TicketType;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Http\Controllers\Controller;

class AdminTicketTypeController extends Controller
{
    public function index()
    {
    //    return $ticketTypes = TicketType::with('plan')->get();
        $ticketTypes = TicketType::paginate(10);
        $priceCurriency = PriceCurrency::first();
        return view('admin.ticket-type.index', compact('ticketTypes','priceCurriency'));
    }

    public function storeTicketType(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'days' => 'required',
            'price' => 'required',
            'description' => 'required|min:4|max:255',
        ]);
        $ticketType = new TicketType();
        $ticketType->price_currency_id = $request->priceCurriency_id;
        $ticketType->name = $request->name;
        $ticketType->price = $request->price;
        $ticketType->days = $request->days;
        $ticketType->description = $request->description;
        $ticketType->save();
        $notify[] = ['success', 'TicketType create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function editTicketType($id)
    {
        $ticketTypes = TicketType::where('id', $id)->first();
        $priceCurriency = PriceCurrency::first();
        return view('admin.ticket-type.edit-ticket-type', compact('ticketTypes','priceCurriency'));
    }

    public function updateTicketType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'price' => 'required',
            'days' => 'required',
            'description' => 'required|min:4|max:255',
        ]);
        $ticketType =  TicketType::where('id', $id)->first();
        $ticketType->price_currency_id = $request->priceCurriency_id;
        $ticketType->name = $request->name;
        $ticketType->price = $request->price;
        $ticketType->days = $request->days;
        //  dd(Carbon::now()->diffInDays($ticketType->date));
        $ticketType->description = $request->description;
        $ticketType->update();
        $notify[] = ['success', 'TicketType Update Successfully'];
        return redirect()->route('admin.ticket.type.index')->withNotify($notify);
    }

    public function destroy($id)
    {
        $ticketTypes = TicketType::find($id);
        $ticketTypes->delete();
        $notify[] = ['success', 'TicketType delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
