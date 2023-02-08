<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use App\Models\UserWallet;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\GeneralSetting;
use App\Models\BookTransaction;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Http\Controllers\Controller;
use App\Models\EventPlan;
use App\Models\EventPlanTransaction;
use App\Models\GeneralUser;
use App\Models\TicketType;
use App\Models\TicketTypeDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EventPlanBuyController extends Controller
{
    public function buyInsert(Request $request)
    {
        // dd($request->all());

        if ($request->method != null) {
            $request->validate([
                'author_event_id' => 'required',
                'event_plan_id' => 'required',
                'method' => 'required',
                'paid_price' => 'required',
            ]);
            $user = auth()->user();
            $gate = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })->where('id', $request->method)->first();
            $eventPlan = EventPlan::where('id', $request->event_plan_id)->with('event.priceCurrency')->first();

            if (!$gate) {
                $notify[] = ['error', 'Invalid gateway'];
                return back()->withNotify($notify);
            }
            if ($gate->min_amount > $gate->max_amount) {
                $notify[] = ['error', 'Please follow payment limit'];
                return back()->withNotify($notify);
            }

            $charge = $gate->fixed_charge + $gate->percent_charge;
            $payable = $request->paid_price + $charge;
            $final_amo = $payable;


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
            $eventPlanDetails = new EventPlanTransaction();
            $eventPlanDetails->event_plan_id = $eventPlan->id;
            $eventPlanDetails->author_event_id = $request->author_event_id;
            $eventPlanDetails->buy_user_id = Auth::guard('general')->user()->id;
            $eventPlanDetails->coupon = $request->coupon_code;
            $eventPlanDetails->discount = $request->discount;
            $eventPlanDetails->payment_getway = $gate->gateway_alias;
            $eventPlanDetails->method_code =  $gate->method_code;
            $eventPlanDetails->method_currency =  strtoupper($gate->currency);
            $eventPlanDetails->transaction_id = $rand_string;
            $eventPlanDetails->charge = $charge;
            $eventPlanDetails->rate = $gate->rate;
            $eventPlanDetails->paid_price = $request->paid_price;
            $eventPlanDetails->final_amo = $final_amo;
            $eventPlanDetails->status = 0;
            $eventPlanDetails->sold = 1;
            $eventPlanDetails->save();
            session()->put('Track', $eventPlanDetails->transaction_id);

            return redirect()->route('event.plan.buy.preview');
        } else {
            dd('ok');
            // $notify[] = ['success', 'Buy Coin Successfully.'];
            // return \redirect()->route('ticket.buy.preview')->withNotify($notify);
        }
    }
    public function preview() //------------------------------------------------------- automatic & manual Preview
    {

        $track = session()->get('Track');
        $data = EventPlanTransaction::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $priceCurrency = PriceCurrency::first();
        // dd($data->gatewayCurrency()->image);
        $pageTitle = 'Payment Preview';
        return view('frontend.pages.event_plan_payment.preview', compact('data', 'pageTitle', 'priceCurrency'));
    }
    public function buyConfirm()  //------------------------------ --------------------automatic & manual confirm
    {
        $track = session()->get('Track');
        $eventPlanDetails = EventPlanTransaction::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();
        if ($eventPlanDetails->method_code >= 1000) {
            $notify[] = ['success', 'Please Follow The  Next Step'];
            return redirect()->route('event.plan.buy.manual.confirm')->withNotify($notify);
        }
        $dirName = 'Gateway' . '\\' . ucwords($eventPlanDetails->gateway->alias);
        $new = 'App\Http\Controllers\\' . $dirName . '\\ProcessController';
        // dd($new);
        $data = $new::buyEventPlanProcess($eventPlanDetails);
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
            $eventPlanDetails->btc_wallet = $data->session->id;
            $eventPlanDetails->save();
        }

        $pageTitle = 'Payment Confirm';
        return view("frontend.pages." . $data->view, compact('data', 'pageTitle', 'eventPlanDetails'));
    }

    public function manualConfirm()
    {

        $track = session()->get('Track');
        $eventPlanDetails = EventPlanTransaction::with('gateway')->where('status', 0)->where('transaction_id', $track)->first();
        if (!$eventPlanDetails) {
            return redirect()->route(gatewayRedirectUrl());
        }
        if ($eventPlanDetails->method_code > 999) {
            $method = $eventPlanDetails->gatewayCurrency();
            // dd($method);
            return view('frontend.pages.manual_payment.manual_event_plan_confirm', compact('eventPlanDetails', 'method'));
        }
        abort(404);
    }

    public function manualUpdate(Request $request)
    {

        $track = session()->get('Track');
        $eventPlanDetails = EventPlanTransaction::with('gateway')->where('status', 0)->where('transaction_id', $track)->first();

        if (!$eventPlanDetails) {
            return redirect()->route(gatewayRedirectUrl());
        }
        $params = json_decode($eventPlanDetails->gatewayCurrency()->gateway_parameter);
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

        $path = imagePath()['verify']['buy_event_plan']['path'];
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
            $eventPlanDetails->detail = $reqField;
        } else {
            $eventPlanDetails->detail = null;
        }
        $eventPlanDetails->status = 2; // pending
        $eventPlanDetails->save();

        // seat sub
        $eventPlan = EventPlan::where('id',$eventPlanDetails->event_plan_id)->first();
        $eventPlan->seat = $eventPlan->seat - 1;
        $eventPlan->update();


        $general = GeneralSetting::first();
        // notify($eventPlanDetails->user, 'DEPOSIT_REQUEST', [
        //     'method_name' => $eventPlanDetails->gatewayCurrency->name,
        //     'method_currency' => $eventPlanDetails->method_currency,
        //     'method_amount' => showAmount($eventPlanDetails->final_amo),
        //     'amount' => showAmount($eventPlanDetails->recharge_amount),
        //     'charge' => showAmount($eventPlanDetails->charge),
        //     'currency' => $general->cur_text,
        //     'rate' => showAmount($eventPlanDetails->rate),
        //     'trx' => $eventPlanDetails->transaction_id
        // ]);

        $notify[] = ['success', 'Your Event plan buy Request Success'];
        return redirect()->route('event.plan.pricing.place.order', $eventPlanDetails->event_plan_id)->withNotify($notify);
    }

    public static function userDataUpdate($trx)
    {
        $general = GeneralSetting::first();
        $eventPlanDetails = EventPlanTransaction::where('transaction_id', $trx)->first();
     
        if ($eventPlanDetails->status == 0) {
            $eventPlanDetails->status = 1;
            $eventPlanDetails->save();

            // seat sub
            $eventPlan = EventPlan::where('id',$eventPlanDetails->event_plan_id)->first();
            $eventPlan->seat = $eventPlan->seat - 1;
            $eventPlan->update();
         
            // ----------------User Wallet balance save----------------
            $user_wallet = UserWallet::where('user_id', $eventPlanDetails->author_event_id)->first();
            
            $user_wallet->balance = $user_wallet->balance + $eventPlanDetails->paid_price;
            $user_wallet->update();

            $user = GeneralUser::find($eventPlanDetails->buy_user_id);


            $notify[] = ['success', 'Your Payment Successful'];
            return redirect()->route('event.plan.pricing.place.order', $eventPlanDetails->event_plan_id)->withNotify($notify);

            // return redirect()->route('event.plan.pricing.place.order', $eventPlanDetails->event_plan_id)->with('success', 'Your Event plan buy Successful');

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
