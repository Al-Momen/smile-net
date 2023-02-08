<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventPlan;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\BookTransaction;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;
use App\Models\EventPlanTransaction;

class ManualEventPlanRequestController extends Controller
{
    public function index()
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user','eventPlans')->where('status','!=', 0)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        // dd($priceCurrency);
        return view('admin.user-event-plan-request.index', compact('allManualEventPlanRequest','priceCurrency'));
    }
    public function approvedAllReq()
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user','eventPlans')->where('status',1)->orderBy('id', 'DESC')->paginate(10);
         $priceCurrency = PriceCurrency::first();
        return view('admin.user-event-plan-request.approve_all_req', compact('allManualEventPlanRequest','priceCurrency'));
    }
     public function pendingAllReq()
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user','eventPlans')->where('method_code','>', 999)->where('status',2)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-event-plan-request.pending_all_req', compact('allManualEventPlanRequest','priceCurrency'));
    }
    public function rejectedAllReq()
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user','eventPlans')->where('method_code','>', 999)->where('status',3)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-event-plan-request.reject_all_req', compact('allManualEventPlanRequest','priceCurrency'));
    }
    public function viewRequest($id)
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user', "eventPlans")->where('id', $id)->first();
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-event-plan-request.view_getway', compact('allManualEventPlanRequest','priceCurrency'));
    }

    public function approved($id)
    {
        $allManualEventPlanRequest = EventPlanTransaction::with('user', "eventPlans")->where('id', $id)->first();
        $allManualEventPlanRequest->status = 1;
        $allManualEventPlanRequest->update();

        // ----------------User Wallet balance save----------------
        $user_wallet = UserWallet::where('user_id', $allManualEventPlanRequest->author_event_id)->first();
        $user_wallet->balance = $user_wallet->balance + $allManualEventPlanRequest->paid_price;
        $user_wallet->update();

        $notify[] = ['success', $allManualEventPlanRequest->user->full_name.' '.'User Event-Plan request is Approved'];
        return redirect()->route('admin.event.manual.index')->withNotify($notify);
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject' =>'required',
        ]);
        
        $allManualEventPlanRequest = EventPlanTransaction::with('user', "eventPlans")->where('id', $id)->first();
        $allManualEventPlanRequest->status = 3;
        $allManualEventPlanRequest->reject = $request->reject;
        $allManualEventPlanRequest->update();


         // seat sub
         $eventPlan = EventPlan::where('id',$allManualEventPlanRequest->event_plan_id)->first();
         $eventPlan->seat = $eventPlan->seat + 1;
         $eventPlan->update();
         
        $notify[] = ['success', 'User Event-Plan request is Cancelled'];
        return redirect()->route('admin.event.manual.index')->withNotify($notify);
    }
}
