<?php

namespace App\Http\Controllers\Frontend;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserManualGetwayRequest;

class UserManualGetwayRequestController extends Controller
{
    public function index()
    {
        $allManualGetwayRequest = UserManualGetwayRequest::with('user', 'priceCurrency')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user-withdraw-request.index', compact('allManualGetwayRequest'));
    }
    public function approvedAllReq()
    {
        $allManualGetwayRequest = UserManualGetwayRequest::with('user', 'priceCurrency')->where('status',1)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user-withdraw-request.approve_all_req', compact('allManualGetwayRequest'));
    }
     public function pendingAllReq()
    {
        $allManualGetwayRequest = UserManualGetwayRequest::with('user', 'priceCurrency')->where('status',0)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user-withdraw-request.pending_all_req', compact('allManualGetwayRequest'));
    }
    public function rejectedAllReq()
    {
        $allManualGetwayRequest = UserManualGetwayRequest::with('user', 'priceCurrency')->where('status',2)->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user-withdraw-request.reject_all_req', compact('allManualGetwayRequest'));
    }
   
    public function viewRequest($id)
    {
        $manualGetwayRequestView = UserManualGetwayRequest::with('user', 'priceCurrency')->where('id', $id)->first();
        return view('admin.user-withdraw-request.view_getway', compact('manualGetwayRequestView'));
    }
    public function approved($id)
    {
        
        $manualGetwayRequestView = UserManualGetwayRequest::where('id', $id)->first();
        $manualGetwayRequestView->status = 1;
        $manualGetwayRequestView->update();
        
        $notify[] = ['success', 'User request is Approved'];
        return redirect()->route('admin.user.manual.getway.request.view',$id)->withNotify($notify);
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject' =>'required',
        ]);


        $manualGetwayRequestView = UserManualGetwayRequest::where('id', $id)->first();
        $manualGetwayRequestView->status = 2;
        $manualGetwayRequestView->reject = $request->reject;
        $manualGetwayRequestView->update();

        //  user money back 
        $userWallet = UserWallet::where('user_id',$manualGetwayRequestView->user_id)->first();
        $userWallet->balance = $userWallet->balance + $manualGetwayRequestView->total;
        $userWallet->update();
        $notify[] = ['success', 'User request is Cancelled'];
        return redirect()->route('admin.user.manual.getway.request.view',$id)->withNotify($notify);
    }
}
