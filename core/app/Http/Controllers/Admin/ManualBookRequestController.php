<?php

namespace App\Http\Controllers\Admin;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\BookTransaction;
use App\Http\Controllers\Controller;

class ManualBookRequestController extends Controller
{
    public function index()
    {
        $allManualBookRequest = BookTransaction::with('user','admin','book')->where('status','!=', 0)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        // dd($allManualBookRequest);
        return view('admin.user-book-request.index', compact('allManualBookRequest','priceCurrency'));
    }
    public function approvedAllReq()
    {
        $allManualBookRequest = BookTransaction::with('user','book')->where('status',1)->orderBy('id', 'DESC')->paginate(10);
         $priceCurrency = PriceCurrency::first();
        return view('admin.user-book-request.approve_all_req', compact('allManualBookRequest','priceCurrency'));
    }
     public function pendingAllReq()
    {
        $allManualBookRequest = BookTransaction::with('user','book')->where('method_code','>', 999)->where('status',2)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-book-request.pending_all_req', compact('allManualBookRequest','priceCurrency'));
    }
    public function rejectedAllReq()
    {
        $allManualBookRequest = BookTransaction::with('user','book')->where('method_code','>', 999)->where('status',3)->orderBy('id', 'DESC')->paginate(10);
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-book-request.reject_all_req', compact('allManualBookRequest','priceCurrency'));
    }
    public function viewRequest($id)
    {
        $manualBookRequestView = BookTransaction::with('user', "book","admin")->where('id', $id)->first();
        $priceCurrency = PriceCurrency::first();
        return view('admin.user-book-request.view_getway', compact('manualBookRequestView','priceCurrency'));
    }

    public function approved($id)
    {
        $manualBookRequestView = BookTransaction::with('user', "book")->where('id', $id)->first();
        $manualBookRequestView->status = 1;
        $manualBookRequestView->update();

        // ----------------User Wallet balance save----------------
        $user_wallet = UserWallet::where('user_id', $manualBookRequestView->author_book_id)->first();
        $user_wallet->balance = $user_wallet->balance + $manualBookRequestView->paid_price;
        $user_wallet->update();
         
        $notify[] = ['success', $manualBookRequestView->user->full_name. ' '.'Book request is Approved'];
        
        return redirect()->route('admin.user.manual.book.request.view',$manualBookRequestView->id )->withNotify($notify);
    }
    public function reject(Request $request, $id)
    {
        $request->validate([
            'reject' =>'required',
        ]);
        $manualBookRequestView = BookTransaction::with('user', "book")->where('id', $id)->first();
        

        $manualBookRequestView->status = 3;
        $manualBookRequestView->reject = $request->reject;
        $manualBookRequestView->update();
        $notify[] = ['success', 'User book request is Cancelled'];
        return redirect()->route('admin.user.manual.book.request.view',$manualBookRequestView->id)->withNotify($notify);
    }
}
