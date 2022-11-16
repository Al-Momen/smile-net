<?php

namespace App\Http\Controllers\Payments;

use Error;
use Stripe;

use App\Models\Book;
use App\Models\Plan;
use App\Models\BookDetails;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PricingDetails;
use App\Models\PlanPricingDetails;
use App\Http\Controllers\Controller;
use App\Models\AdminStripeGetway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);

        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $book = Book::with('priceCurrency')->where('id', $request->book_id)->first();
        $adminStripe = AdminStripeGetway::first();
        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe', compact('book', 'requestValue','adminStripe'));
        }
    }
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
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
        $book = Book::with('priceCurrency')->where('id', $request->book_id)->first();
           Stripe\Stripe::setApiKey($request->stripe_secret);
         

        Stripe\Charge::create([
            "amount" => $request->paid_price * 100,
            "currency" => $book->priceCurrency->code,
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        $bookDetails = new BookDetails();
        $bookDetails->book_id = $book->id;
        $bookDetails->paid_price = $request->paid_price;
        $bookDetails->coupon = $request->coupon_code;
        $bookDetails->discount = $request->discount;
        $bookDetails->payment_getway = $request->payment_getway;
        $bookDetails->transaction_id = $rand_string;
        $bookDetails->sold = 1;
        $bookDetails->save();
        Session::flash('success', 'Payment successful!');

        return redirect()->route('place_order', $book->id)
            ->with('success', 'Transaction complete.');
    }


    //  --------------------------stripe payment gatway for Pricing--------------------------



    public function stripePricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
        // dd($request->all());
        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $pricing = AdminPricing::with('priceCurrency')->where('id', $request->pricing_id)->first();
        $adminStripe = AdminStripeGetway::first();
        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe_pricing', compact('pricing', 'requestValue','adminStripe'));
        }
    }

    public function stripePostPricing(Request $request)
    {
        // dd($request->all());
        // -------------------Generate random key------------------- 
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
        $pricing = AdminPricing::with('priceCurrency')->where('id', $request->pricing_id)->first();
        Stripe\Stripe::setApiKey($request->stripe_secret);
        Stripe\Charge::create([
            "amount" => $request->paid_price * 100,
            "currency" => $pricing->priceCurrency->code,
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $pricingDetails = new PricingDetails();
        $pricingDetails->pricing_id = $pricing->id;
        $pricingDetails->user_id = Auth::guard('general')->user()->id;
        $pricingDetails->paid_price = $request->paid_price;
        $pricingDetails->coupon = $request->coupon_code;
        $pricingDetails->discount = $request->discount;
        $pricingDetails->payment_getway = $request->payment_getway;
        $pricingDetails->transaction_id = $rand_string;
        $pricingDetails->sold = 1;
        $pricingDetails->save();
        Session::flash('success', 'Payment successful!');

        return redirect()->route('pricing.place_order', $pricing->id)
            ->with('success', 'Transaction complete.');
    }




    //  --------------------------stripe payment gatway for plan Pricing--------------------------


    public function stripePlanPricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
        //  dd($request->all());
        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $planPricing = Plan::with('event.priceCurrency')->where('id', $request->plan_id)->first();
        $adminStripe = AdminStripeGetway::first();
        

        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe_plan_pricing', compact('planPricing', 'requestValue','adminStripe'));
        }
    }


    public function stripePostplanPricing(Request $request)
    {
        // dd($request->all());
        // -------------------Generate random key------------------- 
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
        $planPricing = plan::with('event.priceCurrency')->where('id', $request->plan_pricing_id)->first();
        

        $stripe = Stripe\Stripe::setApiKey($request->stripe_secret);
        Stripe\Charge::create([
            "amount" => $request->paid_price * 100,
            "currency" => $planPricing->event->priceCurrency->code,
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $planPricingDetails = new PlanPricingDetails();
        $planPricingDetails->plan_id = $planPricing->id;
        $planPricingDetails->user_id = Auth::guard('general')->user()->id;
        $planPricingDetails->paid_price = $request->paid_price;
        $planPricingDetails->coupon = $request->coupon_code;
        $planPricingDetails->discount = $request->discount;
        $planPricingDetails->payment_getway = $request->payment_getway;
        $planPricingDetails->transaction_id = $rand_string;
        $planPricingDetails->sold = 1;
        $planPricingDetails->save();
        Session::flash('success', 'Payment successful!');

        return redirect()->route('plan.pricing.place.order', $planPricing->id)
            ->with('success', 'Transaction complete.');
    }
}
