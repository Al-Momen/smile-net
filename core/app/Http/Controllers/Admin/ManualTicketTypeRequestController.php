<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\BookTransaction;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManualTicketTypeRequestController extends Controller
{
    public function index()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', 'ticket_type')->where('status', '!=', 0)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        // dd($priceCurrency);
        return view('admin.user-ticket-type-request.index', compact('allManualTicketTypeRequest', 'priceCurrency'));
    }
    public function approvedAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', 'ticket_type')->where('status', 1)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.approve_all_req', compact('allManualTicketTypeRequest', 'priceCurrency'));
    }
    public function pendingAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', 'ticket_type')->where('method_code', '>', 999)->where('status', 2)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.pending_all_req', compact('allManualTicketTypeRequest', 'priceCurrency'));
    }
    public function rejectedAllReq()
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', 'ticket_type')->where('method_code', '>', 999)->where('status', 3)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.reject_all_req', compact('allManualTicketTypeRequest', 'priceCurrency'));
    }
    public function viewRequest($id)
    {
        $allManualTicketTypeRequest = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-ticket-type-request.view_getway', compact('allManualTicketTypeRequest', 'priceCurrency'));
    }

    public function approved($id)
    {

        $manualTicketRequestView = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();

        $check_exist_buy_ticket_type = TicketTypeDetails::with('gateway')->where('user_id', $manualTicketRequestView->user_id)->where('ticket_status', 1)->where('status', 1)->orWhere('status', 2)->first();
        // dd($check_exist_buy_ticket_type);

        if ($check_exist_buy_ticket_type == null) {
            $manualTicketRequestView->status = 1;
            $manualTicketRequestView->date = Carbon::now()->addDay($manualTicketRequestView->ticket_type->days);
            $manualTicketRequestView->update();
        } else {

            $check_exist_buy_ticket_type->ticket_status = 0;
            $check_exist_buy_ticket_type->update();
            $manualTicketRequestView->status = 1; // pending
            $manualTicketRequestView->date = Carbon::now()->addDay($manualTicketRequestView->ticket_type->days);
            $manualTicketRequestView->save();
        }

        $notify[] = ['success', 'User Ticket Type request is Approved'];
        return redirect()->route('admin.ticket.index')->withNotify($notify);
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject' => 'required',
        ]);
        $manualTicketRequestView = TicketTypeDetails::with('user', "ticket_type")->where('id', $id)->first();

        $manualTicketRequestView->status = 3;
        $manualTicketRequestView->reject = $request->reject;
        $manualTicketRequestView->update();
        $notify[] = ['success', 'User Ticket Type request is Cancelled'];
        return redirect()->route('admin.ticket.index')->withNotify($notify);
    }
}
