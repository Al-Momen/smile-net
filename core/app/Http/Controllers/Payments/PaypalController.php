<?php

namespace App\Http\Controllers\Payments;

use App\Models\Book;
use App\Models\BookDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
