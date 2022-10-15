<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminTicketTypeController extends Controller
{
    public function index()
    {
    //    return $ticketTypes = TicketType::with('plan')->get();
        $ticketTypes = TicketType::paginate(10);
        return view('admin.ticket-type.index', compact('ticketTypes'));
    }

    public function storeTicketType(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:4|max:255',
        ]);
        $ticketType = new TicketType();
        $ticketType->name = $request->name;
        $ticketType->description = $request->description;
        $ticketType->save();
        $notify[] = ['success', 'TicketType create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function editTicketType($id)
    {
        $ticketTypes = TicketType::where('id', $id)->first();
        return view('admin.ticket-type.edit-ticket-type', compact('ticketTypes'));
    }

    public function updateTicketType(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:4|max:255',
        ]);
        $ticketTypes =  TicketType::where('id', $id)->first();
        $ticketTypes->name = $request->name;
        $ticketTypes->description = $request->description;
        $ticketTypes->update();
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
