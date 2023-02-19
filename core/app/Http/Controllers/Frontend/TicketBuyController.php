<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Book;
use App\Models\TicketType;
use App\Models\UserWallet;
use App\Models\GeneralUser;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\GeneralSetting;
use App\Models\BookTransaction;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TicketBuyController extends Controller
{
    public function buyInsert(Request $request)
    {
        
        if ($request->method != null) {
            $request->validate([
                'ticket_type_id' => 'required',
                'method' => 'required',
                'paid_price' => 'required',
            ]);


            $user = auth()->user();
            $gate = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })->where('id', $request->method)->first();
            
            $ticketType = TicketType::where('id', $request->ticket_type_id)->first();
            
            if ($request->paid_price <= 0) {
                $notify[] = ['error', 'Subscription Plan Price is 0'];
                return back()->withNotify($notify);
            }
            if (!$gate) {
                $notify[] = ['error', 'Invalid gateway'];
                return back()->withNotify($notify);
            }
            if ($gate->min_amount > $gate->max_amount) {
                $notify[] = ['error', 'Please follow payment limit'];
                return back()->withNotify($notify);
            }
            $charge = $gate->fixed_charge + ($request->paid_price * $gate->percent_charge / 100);
            $payable = $request->paid_price + $charge;
            $final_amo = $payable * $gate->rate;
            
        
            // Generate random key 
            // Available alpha caracters
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ@#$%&*(){}';
            // generate a pin based on 2 * 7 digits + a random character
            $pin = mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)]
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)]
                . mt_rand(1000000, 9999999)
                . $characters[rand(0, strlen($characters) - 1)];
            // String shuffle the result
            $rand_string = str_shuffle($pin);
            $ticketTypeDetails = new TicketTypeDetails();
            $ticketTypeDetails->ticket_type_id = $ticketType->id;
            $ticketTypeDetails->ticket_slug = Str::slug($ticketType->name);
            $ticketTypeDetails->user_id = Auth::guard('general')->user()->id;
            $ticketTypeDetails->coupon = $request->coupon_code;
            $ticketTypeDetails->discount = $request->discount;
            $ticketTypeDetails->payment_getway = $gate->gateway_alias;
            $ticketTypeDetails->method_code =  $gate->method_code;
            $ticketTypeDetails->method_currency =  strtoupper($gate->currency);
            $ticketTypeDetails->transaction_id = $rand_string;
            $ticketTypeDetails->charge = $charge;
            $ticketTypeDetails->rate = $gate->rate;
            
            $ticketTypeDetails->paid_price = $request->paid_price;
            $ticketTypeDetails->final_amo = $final_amo;
            $ticketTypeDetails->status = 0;
            $ticketTypeDetails->sold = 1;
            $ticketTypeDetails->save();
            session()->put('Track', $ticketTypeDetails->transaction_id);
            return redirect()->route('ticket.buy.preview');
        } else {
            dd('ok');
            // $notify[] = ['success', 'Buy Coin Successfully.'];
            // return \redirect()->route('ticket.buy.preview')->withNotify($notify);
        }
    }
    public function preview() //------------------------------------------------------- automatic & manual Preview
    {
        $track = session()->get('Track');
        $data = TicketTypeDetails::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $priceCurrency = PriceCurrency::first();
        // dd($data->gatewayCurrency()->image);
        $pageTitle = 'Payment Preview';
        return view('frontend.pages.ticket_type_payment.preview', compact('data', 'pageTitle','priceCurrency'));
    }
    public function buyConfirm()  //------------------------------ --------------------automatic & manual confirm
    {
        $track = session()->get('Track');
        $ticketTypeDetails = TicketTypeDetails::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();
       
        if ($ticketTypeDetails->method_code >= 1000) {
            $notify[] = ['success', 'Please Follow The  Next Step'];
            return redirect()->route('ticket.buy.manual.confirm');
        }

        $dirName = 'Gateway' . '\\' .ucwords($ticketTypeDetails->gateway->alias);
        
        $new = 'App\Http\Controllers\\' . $dirName . '\\ProcessController';
       
        $data = $new::buyTicketProcess($ticketTypeDetails);
        
        $data = json_decode($data);
        
        if (isset($data->error)) {
            $notify[] = ['error', $data->message];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        if (isset($data->redirect)) {
            return redirect($data->redirect_url);
        }

        // for Stripe V3
        if (@$data->session) {
            $ticketTypeDetails->btc_wallet = $data->session->id;
            $ticketTypeDetails->save();
        }
        // if($coinBuy->method_code == 101){
        //     $this->userDataUpdate($coinBuy->trx);
        // }
        // dd($data->view);
        $pageTitle = 'Payment Confirm';
        return view("frontend.pages.". $data->view, compact('data', 'pageTitle', 'ticketTypeDetails'));
    }

    public function manualConfirm()
    {
        $track = session()->get('Track');
        $ticketTypeDetails = TicketTypeDetails::with('gateway')->where('status', 0)->where('transaction_id', $track)->first();
        if (!$ticketTypeDetails) {
            return redirect()->route(gatewayRedirectUrl());
        }
        if ($ticketTypeDetails->method_code > 999) {
            $method = $ticketTypeDetails->gatewayCurrency();
            // dd($method);
            return view('frontend.pages.manual_payment.manual_ticket_confirm', compact('ticketTypeDetails', 'method'));
        }
        abort(404);
    }

    public function manualUpdate(Request $request)
    {
        $track = session()->get('Track');
        $ticketTypeDetails = TicketTypeDetails::with('gateway','ticket_type')->where('status', 0)->where('transaction_id', $track)->first();
        if (!$ticketTypeDetails) {
            return redirect()->route(gatewayRedirectUrl());
        }
        $params = json_decode($ticketTypeDetails->gatewayCurrency()->gateway_parameter);
        $rules = [];
        $inputField = [];
        $verifyImages = [];

        if ($params != null) {
            foreach ($params as $key => $custom) {
                $rules[$key] = [$custom->validation];
                if ($custom->type == 'file') {
                    array_push($rules[$key], 'image');
                    array_push($rules[$key], new FileTypeValidate(['jpg', 'jpeg', 'png']));
                    array_push($rules[$key], 'max:2048');

                    array_push($verifyImages, $key);
                }
                if ($custom->type == 'text') {
                    array_push($rules[$key], 'max:191');
                }
                if ($custom->type == 'textarea') {
                    array_push($rules[$key], 'max:300');
                }
                $inputField[] = $key;
            }
        }
        $this->validate($request, $rules);

        $path = imagePath()['verify']['buy_ticket']['path'];
        
        $collection = collect($request);
        $reqField = [];
        if ($params != null) {
            foreach ($collection as $k => $v) {
                foreach ($params as $inKey => $inVal) {
                    if ($k != $inKey) {
                        continue;
                    } else {
                        if ($inVal->type == 'file') {
                            if ($request->hasFile($inKey)) {
                                try {
                                    $reqField[$inKey] = [
                                        'field_name' => uploadImage($request[$inKey], $path),
                                        'type' => $inVal->type,
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
                                'type' => $inVal->type,
                            ];
                        }
                    }
                }
            }
            $ticketTypeDetails->detail = $reqField;
        } else {
            $ticketTypeDetails->detail = null;
        }

        
        $check_exist_buy_ticket_type = TicketTypeDetails::with('gateway')->where('user_id', Auth::guard('general')->user()->id)->where('ticket_status',1)->where('status',1)->orWhere('status',2)->first();
        // dd($ticketTypeDetails);
     
        if ($ticketTypeDetails->status == 0) {
            // dd($check_exist_buy_ticket_type);
            if($check_exist_buy_ticket_type == null){
                $ticketTypeDetails->status = 2; // pending
                $ticketTypeDetails->save();
            }else{
               
                $check_exist_buy_ticket_type->ticket_status = 1;
                $check_exist_buy_ticket_type->update();
                $ticketTypeDetails->status = 2; // pending
                $ticketTypeDetails->save();
            }
            
        }

        $general = GeneralSetting::first();
       
        
        // dd($ticketTypeDetails->ticket_type_id);
        $notify[] = ['success', 'Your Ticket buy Request Success'];
        return redirect()->route('ticketType.Pricing.place_order',$ticketTypeDetails->ticket_type_id)->withNotify($notify);
    }

    public static function userDataUpdate($trx)
    {
        $general = GeneralSetting::first();
        $ticketTypeDetails = TicketTypeDetails::where('transaction_id', $trx)->first();
        $check_exist_buy_ticket_type = TicketTypeDetails::with('gateway')->where('user_id', Auth::guard('general')->user()->id)->where('ticket_status',1)->where('status',1)->orWhere('status',2)->first();
    
        
        if ($ticketTypeDetails->status == 0) {
            // dd($check_exist_buy_ticket_type);
            if($check_exist_buy_ticket_type == null){
                
                $ticketTypeDetails->status = 1; // pending
                $ticketTypeDetails->date =Carbon::now()->addDay($ticketTypeDetails->ticket_type->days);
                $ticketTypeDetails->save();
            }else{
               
                $check_exist_buy_ticket_type->ticket_status = 0;
                $check_exist_buy_ticket_type->update();
                $ticketTypeDetails->status = 1; // pending
                $ticketTypeDetails->date =Carbon::now()->addDay($ticketTypeDetails->ticket_type->days);
                $ticketTypeDetails->save();
            }
            
            $user = GeneralUser::find($ticketTypeDetails->user_id);
           

            $notify[] = ['success', 'Your Ticket buy Successful'];
            return redirect()->route('ticketType.Pricing.place_order',$ticketTypeDetails->ticket_type_id)->with($notify);


            // notify($user, 'BUY_COMPLETE', [
            //     'method_name' => $ticketTypeDetails->gatewayCurrency()->name,
            //     'method_currency' => $ticketTypeDetails->method_currency,
            //     'method_amount' => showAmount($ticketTypeDetails->final_amo),
            //     // 'amount' => showAmount($ticketTypeDetails->amount),
            //     'charge' => showAmount($ticketTypeDetails->charge),
            //     'currency' => $general->cur_text,
            //     'rate' => showAmount($ticketTypeDetails->rate),
            //     'trx' => $ticketTypeDetails->trx,
            //     // 'post_balance' => showAmount($user->balance)
            // ]);
        }
    }
}
