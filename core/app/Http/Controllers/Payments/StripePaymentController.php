<?php

namespace App\Http\Controllers\Payments;

use Error;
use Stripe;

use App\Models\Book;
use App\Models\BookDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        if ($request->payment_getway == 'stripe') {
            return view('payments.stripe', compact('book', 'requestValue'));
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
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
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
}
