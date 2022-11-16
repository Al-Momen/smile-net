<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserManualGetwayRequest;

class UserManualGetwayRequestController extends Controller
{
    public function index()
    {
        $allManualGetwayRequest = UserManualGetwayRequest::with('user', 'priceCurrency')->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user-manual-getway-request.index', compact('allManualGetwayRequest'));
    }

    public function viewRequest($id)
    {
        $manualGetwayRequestView = UserManualGetwayRequest::with('user', 'priceCurrency')->where('id', $id)->first();
        return view('admin.user-manual-getway-request.view_getway', compact('manualGetwayRequestView'));
    }
    public function approved($id)
    {
        $manualGetwayRequestView = UserManualGetwayRequest::where('id', $id)->first();
        $manualGetwayRequestView->status = 1;
        $manualGetwayRequestView->update();
        $notify[] = ['success', 'User request is Approved'];
        return redirect()->route('admin.user.manual.getway.request')->withNotify($notify);
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
        $notify[] = ['success', 'User request is Cancelled'];
        return redirect()->route('admin.user.manual.getway.request',$id)->withNotify($notify);
        
    }
}
