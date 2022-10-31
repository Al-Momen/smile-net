<?php

namespace App\Http\Controllers\Payments;

use App\Models\Book;
use App\Models\BookDetails;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PricingDetails;
use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\PlanPricingDetails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function createpaypal()
    {
        return view('payments\paypal_view');
    }

    public function processPaypal(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
        $book = Book::with('priceCurrency')->where('id', $request->book_id)->first();
        if ($request->payment_getway == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess', [
                        'id' => $book->id, 'paid_price' => $request->paid_price, 'payment_getway' => $request->payment_getway, 'coupon_code' => $request->coupon_code,'discount'=>$request->discount
                    ]),
                    "cancel_url" => route('processPaypalCancel', $book->id),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => $book->priceCurrency->code,
                            "value" => $request->paid_price
                        ]
                    ]
                ]
            ]);
            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('place_order', $book->id)
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('place_order', $book->id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
    }
    public function processPaypalSuccess(Request $request, $data)
    {  
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

        $book = Book::with('priceCurrency')->where('id', $data)->first();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            if ($request->coupon_code) {
                $book =new BookDetails();
                $book->book_id = $data;
                $book->paid_price = $request->paid_price;
                $book->coupon = $request->coupon_code;
                $book->discount = $request->discount;
                $book->payment_getway = $request->payment_getway;
                $book->transaction_id = $rand_string;
                $book->sold = 1;
                $book->save();
            } else {
                $book =new BookDetails ();
                $book->book_id = $data;
                $book->paid_price = $request->paid_price;
                $book->coupon = $request->coupon_code;
                $book->discount = $request->discount;
                $book->payment_getway = $request->payment_getway;
                $book->transaction_id = $rand_string;
                $book->sold = 1;
                $book->save();
            }
            $book = Book::with('priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('place_order', $book->id)
                ->with('success', 'Transaction complete.');
        } else {
            $book = Book::with('priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('place_order', $book->id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processPaypalCancel(Request $request, $id)
    {
        $book = Book::with('priceCurrency')->where('id', $id)->first();
        return redirect()
            ->route('place_order', $book->id)
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }



    // -------------------------------Pricing paypal process function-------------------------------

    public function processPaypalPricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
        
        $pricing = AdminPricing::with('priceCurrency')->where('id', $request->pricing_id)->first();
        if ($request->payment_getway == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess.pricing', [
                        'id' => $pricing->id, 'paid_price' => $request->paid_price, 'payment_getway' => $request->payment_getway, 'coupon_code' => $request->coupon_code,'discount'=>$request->discount
                    ]),
                    "cancel_url" => route('processPaypalCancel.pricing', $pricing->id),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => $pricing->priceCurrency->code,
                            "value" => $request->paid_price
                        ]
                    ]
                ]
            ]);
            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('place_order', $pricing->id)
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('place_order', $pricing->id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
    }

    public function processPaypalSuccessPricing(Request $request, $data)
    {  
        // --------------------------Generate random key-------------------------- 
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
        
        $pricing = AdminPricing::with('priceCurrency')->where('id', $data)->first();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            if ($request->coupon_code) {
                $pricingDetails =new PricingDetails();
                $pricingDetails->pricing_id = $data;
                $pricingDetails->user_id = Auth::guard('general')->user()->id;
                $pricingDetails->paid_price = $request->paid_price;
                $pricingDetails->coupon = $request->coupon_code;
                $pricingDetails->discount = $request->discount;
                $pricingDetails->payment_getway = $request->payment_getway;
                $pricingDetails->transaction_id = $rand_string;
                $pricingDetails->sold = 1;
                $pricingDetails->save();
            } else {
                $pricingDetails =new PricingDetails ();
                $pricingDetails->pricing_id = $data;
                $pricingDetails->paid_price = $request->paid_price;
                $pricingDetails->user_id = Auth::guard('general')->user()->id;
                $pricingDetails->coupon = $request->coupon_code;
                $pricingDetails->discount = $request->discount;
                $pricingDetails->payment_getway = $request->payment_getway;
                $pricingDetails->transaction_id = $rand_string;
                $pricingDetails->sold = 1;
                $pricingDetails->save();
            }
            $pricing = AdminPricing::with('priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('pricing.place_order', $pricing->id)
                ->with('success', 'Transaction complete.');
        } else {
            $pricing = AdminPricing::with('priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('pricing.place_order', $pricing->id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function processPaypalCancelPricing(Request $request, $id)
    {
        $pricing = AdminPricing::with('priceCurrency')->where('id', $id)->first();
        return redirect()
            ->route('pricing.place_order', $pricing->id)
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


    // ------------------------------- plan Pricing paypal process function-------------------------------

    public function processPaypalPlanPricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
        // dd($request->all());
        $planPricing = Plan::with('event.priceCurrency')->where('id', $request->plan_id)->first();
        if ($request->payment_getway == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess.plan.pricing', [
                        'id' => $planPricing->id, 'paid_price' => $request->paid_price, 'payment_getway' => $request->payment_getway, 'coupon_code' => $request->coupon_code,'discount'=>$request->discount
                    ]),
                    "cancel_url" => route('processPaypalCancel.plan.pricing', $planPricing->id),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => $planPricing->event->priceCurrency->code,
                            "value" => $request->paid_price
                        ]
                    ]
                ]
            ]);
            if (isset($response['id']) && $response['id'] != null) {
                // redirect to approve href
                foreach ($response['links'] as $links) {
                    if ($links['rel'] == 'approve') {
                        return redirect()->away($links['href']);
                    }
                }
                return redirect()
                    ->route('plan.pricing.place.order', $planPricing->id)
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('plan.pricing.place.order', $planPricing->id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
    }

    public function processPaypalSuccessPlanPricing(Request $request, $data)
    {  
        // --------------------------Generate random key-------------------------- 
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

        // dd($data);
        
        $pricing = Plan::with('event.priceCurrency')->where('id', $data)->first();
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            if ($request->coupon_code) {
                $planPricingDetails =new PlanPricingDetails();
                $planPricingDetails->plan_pricing_id = $data;
                $planPricingDetails->user_id = Auth::guard('general')->user()->id;
                $planPricingDetails->paid_price = $request->paid_price;
                $planPricingDetails->coupon = $request->coupon_code;
                $planPricingDetails->discount = $request->discount;
                $planPricingDetails->payment_getway = $request->payment_getway;
                $planPricingDetails->transaction_id = $rand_string;
                $planPricingDetails->sold = 1;
                $planPricingDetails->save();
            } else {
                $planPricingDetails =new PlanPricingDetails();
                $planPricingDetails->plan_pricing_id = $data;
                $planPricingDetails->paid_price = $request->paid_price;
                $planPricingDetails->user_id = Auth::guard('general')->user()->id;
                $planPricingDetails->coupon = $request->coupon_code;
                $planPricingDetails->discount = $request->discount;
                $planPricingDetails->payment_getway = $request->payment_getway;
                $planPricingDetails->transaction_id = $rand_string;
                $planPricingDetails->sold = 1;
                $planPricingDetails->save();
            }
            $planPricing = Plan::with('event.priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('plan.pricing.place.order', $planPricing->id)
                ->with('success', 'Transaction complete.');
        } else {
            $planPricing = Plan::with('event.priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('plan.pricing.place.order', $planPricing->id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processPaypalCancelPlanPricing(Request $request, $id)
    {
        $planPricing = Plan::with('event.priceCurrency')->where('id', $id)->first();
        return redirect()
            ->route('pricing.place_order', $planPricing->id)
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}
