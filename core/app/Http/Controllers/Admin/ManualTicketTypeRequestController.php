<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\BookTransaction;
use App\Http\Controllers\Controller;
use App\Models\TicketTypeDetails;
use Carbon\Carbon;

class ManualTicketTypeRequestController extends Controller
{
    public function index()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user','ticket_type')->where('status','!=', 0)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        // dd($priceCurrency);
        return view('admin.user-ticket-type-request.index', compact('allManualTicketTypeRequest','priceCurrency'));
    }
    public function approvedAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user','ticket_type')->where('status',1)->orderBy('id', 'DESC')->paginate(10);
         $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.approve_all_req', compact('allManualTicketTypeRequest','priceCurrency'));
    }
     public function pendingAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user','ticket_type')->where('method_code','>', 999)->where('status',2)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.pending_all_req', compact('allManualTicketTypeRequest','priceCurrency'));
    }
    public function rejectedAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user','ticket_type')->where('method_code','>', 999)->where('status',3)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.reject_all_req', compact('allManualTicketTypeRequest','priceCurrency'));
    }
    public function viewRequest($id)
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.view_getway', compact('allManualTicketTypeRequest','priceCurrency'));
    }

    public function approved($id)
    {
        $manualTicketRequestView = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();
        $manualTicketRequestView->status = 1;
        $manualTicketRequestView->date = Carbon::now()->addDay($manualTicketRequestView->ticket_type->days);
        // dd($manualTicketRequestView->date);
        $manualTicketRequestView->update();
         
        $notify[] = ['success', 'User Ticket Type request is Approved'];
        return redirect()->route('admin.ticket.index')->withNotify($notify);
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject' =>'required',
        ]);
        $manualTicketRequestView = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();
        $manualTicketRequestView->status = 3;
        $manualTicketRequestView->reject = $request->reject;
        $manualTicketRequestView->update();
        $notify[] = ['success', 'User Ticket Type request is Cancelled'];
        return redirect()->route('admin.ticket.index')->withNotify($notify);
    }
}
