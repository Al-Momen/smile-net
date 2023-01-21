<?php

namespace App\Http\Controllers\Payments;

use Error;
use Stripe;

use App\Models\Book;
use App\Models\Plan;
use App\Models\EventPlan;
use App\Models\TicketType;
use App\Models\BookDetails;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PricingDetails;
use App\Models\BookTransaction;
use App\Models\AdminStripeGetway;
use App\Models\TicketTypeDetails;
use App\Models\PlanPricingDetails;
use App\Http\Controllers\Controller;
use App\Models\EventPlanTransaction;
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
            'select_gateway' => 'required',
        ]);
        // dd($request->all());
        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $book = Book::with('priceCurrency')->where('id', $request->book_id)->first();
        $adminStripe = AdminStripeGetway::first();
        
        if ($request->select_gateway == 'stripe') {
            return view('payments.stripe', compact('book', 'requestValue', 'adminStripe'));
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

        $bookDetails = new BookTransaction();
        $bookDetails->book_id = $book->id;
        $bookDetails->author_book_id = $book->author_book_id;
        $bookDetails->author_book_type = $book->author_book_type;
        $bookDetails->buy_user_id = Auth::guard('general')->user()->id;
        $bookDetails->paid_price = $request->paid_price;
        $bookDetails->coupon = $request->coupon_code;
        $bookDetails->discount = $request->discount;
        $bookDetails->payment_getway = $request->select_gateway;
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
        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $ticketType = TicketType::with('priceCurrency')->where('id', $request->ticket_type_id)->first();
        $adminStripe = AdminStripeGetway::first();
        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe_pricing', compact('ticketType', 'requestValue', 'adminStripe'));
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
        $ticketType = TicketType::with('priceCurrency')->where('id', $request->ticket_type_id)->first();
        // dd($ticketType);
        Stripe\Stripe::setApiKey($request->stripe_secret);
        Stripe\Charge::create([
            "amount" => $request->paid_price * 100,
            "currency" => $ticketType->priceCurrency->code,
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);

        // if(Auth::guard('general')->user()){
        //     $ticketTypeDetails =  TicketTypeDetails::where('user_id',Auth::guard('general')->user()->id)->first();
        //     $ticketTypeDetails->delete();
        // }
        $ticketTypeDetails = TicketTypeDetails::where('user_id', Auth::guard('general')->user()->id)->first();
        if ($ticketTypeDetails != null) {
            $ticketTypeDetails->ticket_type_id = $ticketType->id;
            $ticketTypeDetails->ticket_slug = $ticketType->name;
            $ticketTypeDetails->user_id = Auth::guard('general')->user()->id;
            $ticketTypeDetails->paid_price = $request->paid_price;
            $ticketTypeDetails->coupon = $request->coupon_code;
            $ticketTypeDetails->discount = $request->discount;
            $ticketTypeDetails->payment_getway = $request->payment_getway;
            $ticketTypeDetails->transaction_id = $rand_string;
            $ticketTypeDetails->sold = 1;
            $ticketTypeDetails->update();
            Session::flash('success', 'Payment successful!');

            return redirect()->route('ticketType.Pricing.place_order', $ticketType->id)
                ->with('success', 'Transaction complete.');
        }

        $ticketTypeDetails = new TicketTypeDetails();
        $ticketTypeDetails->ticket_type_id = $ticketType->id;
        $ticketTypeDetails->ticket_slug = $ticketType->name;
        $ticketTypeDetails->user_id = Auth::guard('general')->user()->id;
        $ticketTypeDetails->paid_price = $request->paid_price;
        $ticketTypeDetails->coupon = $request->coupon_code;
        $ticketTypeDetails->discount = $request->discount;
        $ticketTypeDetails->payment_getway = $request->payment_getway;
        $ticketTypeDetails->transaction_id = $rand_string;
        $ticketTypeDetails->sold = 1;
        $ticketTypeDetails->save();
        Session::flash('success', 'Payment successful!');

        return redirect()->route('ticketType.Pricing.place_order', $ticketType->id)
            ->with('success', 'Transaction complete.');
    }


    //  --------------------------stripe payment gatway for plan Pricing--------------------------


    public function stripePlanPricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);
         
        $requestArray = $request->all();
        $requestValue = (object)$requestArray;
        $eventPlanPricing = EventPlan::with('event.priceCurrency')->where('id', $request->event_plan_id)->first();
       
        $adminStripe = AdminStripeGetway::first();

        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe_plan_pricing', compact('eventPlanPricing', 'requestValue', 'adminStripe'));
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
        $eventPlanPricing = EventPlan::with('event.priceCurrency')->where('id', $request->eventPlanPricing_id)->first();


        $stripe = Stripe\Stripe::setApiKey($request->stripe_secret);
        Stripe\Charge::create([
            "amount" => $request->paid_price * 100,
            "currency" => $eventPlanPricing->event->priceCurrency->code,
            "source" => $request->stripeToken,
            "description" => "Test payment from itsolutionstuff.com."
        ]);
        $eventPlanTransaction = new EventPlanTransaction();
        $eventPlanTransaction->event_plan_id = $eventPlanPricing->id;
        $eventPlanTransaction->author_event_id = $eventPlanPricing->author_event_id;
        $eventPlanTransaction->buy_user_id = Auth::guard('general')->user()->id;
        $eventPlanTransaction->paid_price = $request->paid_price;
        $eventPlanTransaction->coupon = $request->coupon_code;
        $eventPlanTransaction->discount = $request->discount;
        $eventPlanTransaction->payment_getway = $request->payment_getway;
        $eventPlanTransaction->transaction_id = $rand_string;
        $eventPlanTransaction->sold = 1;
        $eventPlanTransaction->save();
        Session::flash('success', 'Payment successful!');

        return redirect()->route('event.plan.pricing.place.order', $eventPlanPricing->id)
            ->with('success', 'Transaction complete.');
    }
}
