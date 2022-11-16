<?php

namespace App\Http\Controllers\Frontend;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\UserManualgetway;
use App\Models\AdminManualGetway;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserManualGetwayRequest;

class UserWithDrawController extends Controller
{
    public function index()
    {
        $manualGetways = AdminManualGetway::where('status', 1)->get();
        return view('frontend.deshboard.pages.withdraw.withdraw', compact('manualGetways'));
    }

    public function withdrawRequest(Request $request)
    {
        //  dd($request->all());
        $request->validate([
            'gateway' => 'required|integer',
        ]);
        $gateway = AdminManualGetway::where('code', $request->gateway)->first();

        $request->validate([
            'amount' => 'required|gte:' . $gateway->minium_amount,
            'amount' => 'required|lte:' . $gateway->maximum_amount,
        ]);
        $gateway_parameters =  json_decode($gateway->user_data);
        
        $validation_rules = [];
        foreach($gateway_parameters as $item) {
            $validation_rules[$item->field_name] = $item->field_validation;
        }
        // dd($validation_rules);
        $validated = $request->validate($validation_rules);
        // dd($validated);
        $set_user_data = [];
        foreach($gateway_parameters as $item) {
            $set_user_data[$item->field_name] = [
                'field_lavel' => $item->field_level,
                'field_type' => $item->field_type,
                'value'     => $validated[$item->field_name],  
            ];
        }
        // dd($set_user_data);
        $set_user_data = json_encode($set_user_data);
        //    ----------------user wallet balance check----------------

        $userWallet = UserWallet::where('user_id', Auth::guard('general')->user()->id)->first();

        $amount = doubleval($request->amount);
        $amountPercentChage = ($request->amount / 100) * $gateway->percent_charge;
        $amountFixedCharge =  $gateway->fixed_charge;
        $total = $amount + $amountPercentChage + $amountFixedCharge;
        if (doubleval($userWallet->balance) >= doubleval($total)) {
            $userWallet->balance = $userWallet->balance - $total;
            $userWallet->update();

            $userManualgetway = new UserManualGetwayRequest();
            $userManualgetway->user_id = Auth::guard('general')->user()->id;
            $userManualgetway->currency_id = $gateway->currency_id;
            $userManualgetway->gateway_method = $gateway->name;
            $userManualgetway->transaction_no = rand(12345673,94876543);
            $userManualgetway->amount = $request->amount;
            $userManualgetway->gateway_parameters = $set_user_data;
            $userManualgetway->status = 0;
            $userManualgetway->save();
            $notify[] = ['success', 'Withdraw request Successfully'];
            return redirect()->back()->withNotify($notify);
        }else{
            $notify[] = ['success', 'Youe wallet hanve not enough Money'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function withdraw_history()
    {
       $withdrawHistory = UserManualGetwayRequest::where('user_id', Auth::guard('general')->user()->id)->paginate(8);
        return view('frontend.deshboard.pages.withdraw.withdraw_history', compact('withdrawHistory'));
    }

    public function user_manual_getway_request_view($id)
    {
        $gate_request_view = UserManualGetwayRequest::with('user', 'priceCurrency')->where('id', $id)->first();
        return view('frontend.deshboard.pages.withdraw.withdraw_view', compact('gate_request_view'));
    }
}
