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
use App\Models\GeneralUser;
use Illuminate\Support\Facades\Auth;

class BookBuyController extends Controller
{
    public function buyInsert(Request $request)
    {
        // dd($request->all());
        if ($request->method != null) {
            $request->validate([
                'book_id' => 'required',
                'method' => 'required',
                'paid_price' => 'required',
            ]);
            $user = auth()->user();
            $gate = GatewayCurrency::whereHas('method', function ($gate) {
                $gate->where('status', 1);
            })->where('id', $request->method)->first();
            
             $book = Book::where('id', $request->book_id)->first();
            
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
            $bookTransaction = new BookTransaction();
            $bookTransaction->book_id = $book->id;
            $bookTransaction->author_book_id = $book->author_book_id;
            $bookTransaction->author_book_type = $book->author_book_type;
            $bookTransaction->buy_user_id = Auth::guard('general')->user()->id;
            $bookTransaction->coupon = $request->coupon_code;
            $bookTransaction->discount = $request->discount;
            $bookTransaction->payment_getway = $gate->gateway_alias;
            $bookTransaction->method_code =  $gate->method_code;
            $bookTransaction->method_currency =  strtoupper($gate->currency);
            $bookTransaction->transaction_id = $rand_string;
            $bookTransaction->charge = $charge;
            $bookTransaction->rate = $gate->rate;
            $bookTransaction->paid_price = $request->paid_price;
            $bookTransaction->final_amo = $final_amo;
            $bookTransaction->status = 0;
            $bookTransaction->sold = 1;
            $bookTransaction->save();
            session()->put('Track', $bookTransaction->transaction_id);
            return redirect()->route('book.buy.preview');
        } else {
            dd('ok');
            $notify[] = ['success', 'Buy Coin Successfully.'];
            return \redirect()->route('user.buy.log')->withNotify($notify);
        }
    }
    public function preview() //------------------------------------------------------- automatic & manual Preview
    {
        $track = session()->get('Track');
        $data = BookTransaction::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->firstOrFail();
        $priceCurrency = PriceCurrency::first();
        // dd($data);
        $pageTitle = 'Payment Preview';
        return view('frontend.pages.payment.preview', compact(
            'data',
            'pageTitle',
            'priceCurrency'
        ));
    }
    public function buyConfirm()  //------------------------------ ----------------------automatic $ manual confirm
    {
        $track = session()->get('Track');
        $bookTransaction = BookTransaction::where('transaction_id', $track)->where('status', 0)->orderBy('id', 'DESC')->with('gateway')->firstOrFail();

        if ($bookTransaction->method_code >= 1000) {
            $notify[] = ['success', 'Please Follow The  Next Step'];
            return redirect()->route('book.buy.manual.confirm')->withNotify($notify);
        }

        $dirName = 'Gateway' . '\\' . ucwords($bookTransaction->gateway->alias);
        $new = 'App\Http\Controllers\\' . $dirName . '\\ProcessController';

        $data = $new::buyBookProcess($bookTransaction);
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
            $bookTransaction->btc_wallet = $data->session->id;
            $bookTransaction->save();
        }
        
        $pageTitle = 'Payment Confirm';
        return view("frontend.pages.". $data->view, compact('data', 'pageTitle', 'bookTransaction'));
    }

    public function manualConfirm()
    {
        $track = session()->get('Track');
        $bookTransaction = BookTransaction::with('gateway')->where('status', 0)->where('transaction_id', $track)->first();
        if (!$bookTransaction) {
            return redirect()->route(gatewayRedirectUrl());
        }
        if ($bookTransaction->method_code > 999) {
            $method = $bookTransaction->gatewayCurrency();
            return view('frontend.pages.manual_payment.manual_confirm', compact('bookTransaction', 'method'));
        }
        abort(404);
    }

    public function manualUpdate(Request $request)
    {
        $track = session()->get('Track');
        $bookTransaction = BookTransaction::with('gateway')->where('status', 0)->where('transaction_id', $track)->first();
        if (!$bookTransaction) {
            return redirect()->route(gatewayRedirectUrl());
        }
        $params = json_decode($bookTransaction->gatewayCurrency()->gateway_parameter);
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

        $path = imagePath()['verify']['buy_book']['path'];
        
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
            $bookTransaction->detail = $reqField;
        } else {
            $bookTransaction->detail = null;
        }
        $bookTransaction->status = 2; // pending
        $bookTransaction->save();

        $general = GeneralSetting::first();
        // notify($bookTransaction->user, 'DEPOSIT_REQUEST', [
        //     'method_name' => $bookTransaction->gatewayCurrency->name,
        //     'method_currency' => $bookTransaction->method_currency,
        //     'method_amount' => showAmount($bookTransaction->final_amo),
        //     'amount' => showAmount($bookTransaction->recharge_amount),
        //     'charge' => showAmount($bookTransaction->charge),
        //     'currency' => $general->cur_text,
        //     'rate' => showAmount($bookTransaction->rate),
        //     'trx' => $bookTransaction->transaction_id
        // ]);
        
        $notify[] = ['success', 'Your Booking Request Success'];
        return redirect()->route('place_order',$bookTransaction->book_id)->withNotify($notify);
    }

    public static function userDataUpdate($trx)
    {
        $general = GeneralSetting::first();
        $bookTransaction = BookTransaction::where('transaction_id', $trx)->first();
        if ($bookTransaction->status == 0) {
            $bookTransaction->status = 1;
            $bookTransaction->save();

             // ----------------User Wallet balance save----------------
             $user_wallet = UserWallet::where('user_id', $bookTransaction->author_book_id)->first();
             $user_wallet->balance = $user_wallet->balance + $bookTransaction->paid_price;
             $user_wallet->update();

             $user = GeneralUser::find($bookTransaction->buy_user_id);
             $notify[] = ['success', 'Your Payment Successful'];
             return redirect()->route('place_order',$bookTransaction->book_id)->withNotify($notify);
            // notify($user, 'BUY_COMPLETE', [
            //     'method_name' => $bookTransaction->gatewayCurrency()->name,
            //     'method_currency' => $bookTransaction->method_currency,
            //     'method_amount' => showAmount($bookTransaction->final_amo),
            //     // 'amount' => showAmount($bookTransaction->amount),
            //     'charge' => showAmount($bookTransaction->charge),
            //     'currency' => $general->cur_text,
            //     'rate' => showAmount($bookTransaction->rate),
            //     'trx' => $bookTransaction->trx,
            //     // 'post_balance' => showAmount($user->balance)
            // ]);
        }
    }
}
