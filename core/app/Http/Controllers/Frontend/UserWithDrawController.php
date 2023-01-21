<?php

namespace App\Http\Controllers\Frontend;

use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Rules\FileTypeValidate;
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
        $request->validate([
            'gateway' => 'required|integer',
            'amount' => 'required|numeric|gt:0'
        ]);
        
        $gateway = AdminManualGetway::where('code', $request->gateway)->first();
        $userWallet = UserWallet::where('user_id', Auth::guard('general')->user()->id)->first();
        
        $amount = doubleval($request->amount);
        $amountPercentChage = ($request->amount / 100) * $gateway->percent_charge;
        $amountFixedCharge =  $gateway->fixed_charge;
        $total = $amount + $amountPercentChage + $amountFixedCharge;
        if($userWallet->balance < $total){
            $notify[]=['error','Your wallet have not enough Money'];
            return redirect()->back()->withNotify($notify);
        }

        if ($request->amount > $gateway->maximum_amount) {
            $notify[] = ['error', 'Amount must be less then maximum limited amount'];
            return back()->withNotify($notify);
        }
        if ($request->amount < $gateway->minium_amount) {
            $notify[] = ['error', 'Amount must be greater then minimum limited amount'];
            return back()->withNotify($notify);
        }

        // $request->validate([
        //     'amount' => 'required|gte:' . $gateway->minium_amount,
        //     'amount' => 'required|lte:' . $gateway->maximum_amount,
        // ]);
        
        $data = [];
        $data = [
            'amount'=> $request->amount,
            'gateway' => $gateway,
        ];
        session()->put('data', $data);
        return redirect()->route('user.withdraw.preview');
    }


    public function preview()
    {
        $data = session()->get('data');
        $data = (Object) $data;
        // dd($data);
        return view('frontend.deshboard.pages.withdraw.withdraw_confirm',compact('data'));
    }

    public function store(Request $request)
    {
        $data = session()->get('data');
        $data = (Object) $data;
        $amount = doubleval($data->amount);
        $userWallet = UserWallet::where('user_id',Auth::guard('general')->user()->id)->first();
        
        $amountPercentChage = doubleval(($amount / 100) * $data->gateway->percent_charge);
        $amountFixedCharge =  doubleval($data->gateway->fixed_charge);
        $total = doubleval($amount + $amountPercentChage + $amountFixedCharge);
        
        $params =  json_decode($data->gateway->user_data) ;
        // dd($params);
        $rules = [];
        $inputField = [];
        $verifyImages = [];
       
        
        if ($params != null) {
            foreach ($params as $key => $custom) {
                $rules[$key] = [$custom->field_validation];
                if ($custom->field_type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg', 'jpeg', 'png']));
                    array_push($rules[$key], 'max:2048');
                    array_push($verifyImages, $key);
                }
                if ($custom->field_type == 'input') {
                    array_push($rules[$key], 'max:191');
                }
                if ($custom->field_type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        
        $this->validate($request, $rules);
        $path = imagePath()['withdraw']['method']['path'];

        $collection = collect($request);
        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->field_type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => uploadImage($request[$inKey], $path),
                                        'field_type' => $inVal->field_type,
                                    ];
                                } catch (\Exception $exp) {
                                    $notify[] = ['error', 'Could not upload your ' . $inKey];
                                    return back()->withNotify($notify)->withInput();
                                }
                            }
                        } else {
                            $reqField[$inKey] = $v;
                            $reqField[$inKey] = [
                                'field_name' => $v,
                                'field_type' => $inVal->field_type,
                            ];
                        }
                    }
                }
            }
            $userWallet->balance = $userWallet->balance - $total;
            // dd($userWallet);
            $userWallet->update();
            $userManualgetway = new UserManualGetwayRequest();
            $userManualgetway->user_id = Auth::guard('general')->user()->id;
            $userManualgetway->currency_id = $data->gateway->currency_id;
            $userManualgetway->gateway_method = $data->gateway->name;
            $userManualgetway->transaction_no = rand(12345673,94876543);
            $userManualgetway->fixed_charge = doubleval($data->gateway->fixed_charge);
            $userManualgetway->percent_charge = doubleval($data->gateway->percent_charge);
            $userManualgetway->amount = $amount;
            $userManualgetway->total = doubleval($total);
            $userManualgetway->gateway_parameters = json_encode($reqField);
            $userManualgetway->status = 0;
            // dd($userManualgetway);
            $userManualgetway->save();
            $notify[] = ['success', 'Withdraw request Successfully'];
            return redirect()->route('user.withdraw')->withNotify($notify);
        } else {
            // $userManualgetway->detail = null;
            dd('ok');
        }
        
        //    ----------------user wallet balance check----------------
        return view('frontend.deshboard.pages.withdraw.withdraw_confirm',compact('data'));
    }

    public function withdraw_history()
    {
       $withdrawHistory = UserManualGetwayRequest::where('user_id', Auth::guard('general')->user()->id)->orderBy('id',"DESC")->paginate(8);
        return view('frontend.deshboard.pages.withdraw.withdraw_history', compact('withdrawHistory'));
    }

    public function user_manual_getway_request_view($id)
    {
        $gate_request_view = UserManualGetwayRequest::with('user', 'priceCurrency')->where('id', $id)->first();
        return view('frontend.deshboard.pages.withdraw.withdraw_view', compact('gate_request_view'));
    }
}
