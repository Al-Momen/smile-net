<?php

namespace App\Http\Controllers\Payments;

use App\Models\Book;

use App\Models\Plan;
use App\Models\Currency;
use App\Models\EventPlan;
use App\Models\TicketType;
use App\Models\UserWallet;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\PricingDetails;
use App\Models\BookTransaction;
use App\Models\AdminPaypalGetway;
use App\Models\TicketTypeDetails;
use App\Models\PlanPricingDetails;
use App\Http\Controllers\Controller;
use App\Models\EventPlanTransaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
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
            'select_gateway' => 'required',
        ]);
        
        $book = Book::with('priceCurrency')->where('id', $request->book_id)->first();
        if ($request->select_gateway == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials($this->paypalConfig());
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess', [
                        'id' => $book->id, 'paid_price' => $request->paid_price, 'select_gateway' => $request->select_gateway, 'coupon_code' => $request->coupon_code, 'discount' => $request->discount,
                        'author_book_id' => $book->author_book_id, 'author_book_type' => $book->author_book_type
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
        // dd($request->all());
        $book = Book::with('priceCurrency')->where('id', $data)->first();
        $provider = new PayPalClient;
        $provider->setApiCredentials($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $bookTransaction = new BookTransaction();
            $bookTransaction->book_id = $data;
            $bookTransaction->author_book_id = $request->author_book_id;
            $bookTransaction->author_book_type = $request->author_book_type;
            $bookTransaction->buy_user_id = Auth::guard('general')->user()->id;
            $bookTransaction->paid_price = $request->paid_price;
            $bookTransaction->coupon = $request->coupon_code;
            $bookTransaction->discount = $request->discount;
            $bookTransaction->payment_getway = $request->select_gateway;
            $bookTransaction->transaction_id = $rand_string;
            $bookTransaction->sold = 1;
            $bookTransaction->save();

            // ----------------User Wallet balance save----------------
            $user_wallet = UserWallet::where('user_id', $bookTransaction->author_book_id)->first();
            $user_wallet->balance = $user_wallet->balance + $bookTransaction->paid_price;
            $user_wallet->update();


            return redirect()
                ->route('place_order', $book->id)
                ->with('success', 'Transaction complete.');
        } else {
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

    // -------------------------------Ticket type Pricing paypal process function-------------------------------

    public function processPaypalTicketTypePricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);

        $ticketTypePricing = TicketType::with('priceCurrency')->where('id', $request->ticket_type_id)->first();
        if ($request->payment_getway == 'paypal') {
            $provider = new PayPalClient;
            $provider->setApiCredentials($this->paypalConfig());
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess.ticket_type.pricing', [
                        'id' => $ticketTypePricing->id, 'paid_price' => $request->paid_price, 'payment_getway' => $request->payment_getway, 'coupon_code' => $request->coupon_code, 'discount' => $request->discount
                    ]),
                    "cancel_url" => route('processPaypalCancel.ticket_type.pricing', $ticketTypePricing->id),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => $ticketTypePricing->priceCurrency->code,
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
                    ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }
    }

    public function processPaypalSuccessTicketTypePricing(Request $request, $data)
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
        

        $ticketTypePricing = TicketType::with('priceCurrency')->where('id', $data)->first();
        $ticketTypeDetails =  TicketTypeDetails::where('user_id',Auth::guard('general')->user()->id)->first();
        if($ticketTypeDetails != null){
            
            $provider = new PayPalClient;
            $provider->setApiCredentials($this->paypalConfig());
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                // dd($request->all());
                $ticketTypeDetails->ticket_type_id = $data;
                $ticketTypeDetails->ticket_slug = Str::slug($ticketTypePricing->name);
                $ticketTypeDetails->user_id = Auth::guard('general')->user()->id;
                $ticketTypeDetails->paid_price = $request->paid_price;
                $ticketTypeDetails->coupon = $request->coupon_code;
                $ticketTypeDetails->discount = $request->discount;
                $ticketTypeDetails->payment_getway = $request->payment_getway;
                $ticketTypeDetails->transaction_id = $rand_string;
                $ticketTypeDetails->sold = 1;
                $ticketTypeDetails->update();
                return redirect()
                    ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                    ->with('success', 'Transaction complete.');
            } else {
    
                return redirect()
                    ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                    ->with('error', $response['message'] ?? 'Something went wrong.');
            }
        }


        $provider = new PayPalClient;
        $provider->setApiCredentials($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // dd($request->all());
            $ticketTypeDetails = new TicketTypeDetails();
            $ticketTypeDetails->ticket_type_id = $data;
            $ticketTypeDetails->ticket_slug = Str::slug($ticketTypePricing->name);
            $ticketTypeDetails->user_id = Auth::guard('general')->user()->id;
            $ticketTypeDetails->paid_price = $request->paid_price;
            $ticketTypeDetails->coupon = $request->coupon_code;
            $ticketTypeDetails->discount = $request->discount;
            $ticketTypeDetails->payment_getway = $request->payment_getway;
            $ticketTypeDetails->transaction_id = $rand_string;
            $ticketTypeDetails->sold = 1;
            $ticketTypeDetails->save();
            return redirect()
                ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                ->with('success', 'Transaction complete.');
        } else {

            return redirect()
                ->route('ticketType.Pricing.place_order', $ticketTypePricing->id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    public function processPaypalCancelTicketTypePricing(Request $request, $id)
    {
        $ticketTypePricing = TicketType::with('priceCurrency')->where('id', $id)->first();
        return redirect()
            ->route('processPaypalCancel.ticket_type.pricing', $ticketTypePricing->id)
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


    // ------------------------------- plan Pricing paypal process function-------------------------------

    public function processPaypalPlanPricing(Request $request)
    {
        $request->validate([
            'payment_getway' => 'required',
        ]);

        $eventPlanPricing = EventPlan::with('event.priceCurrency')->where('id', $request->event_plan_id)->first();
        if ($request->payment_getway == 'paypal') {
            $paypal_config = $this->paypalConfig();
            $provider = new PayPalClient;
            $provider->setApiCredentials($paypal_config);
            $paypalToken = $provider->getAccessToken();

            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('processPaypalSuccess.plan.pricing', [
                        'id' => $eventPlanPricing->id, 'paid_price' => $request->paid_price, 'payment_getway' => $request->payment_getway, 'coupon_code' => $request->coupon_code, 'discount' => $request->discount, 'author_event_id' => $request->author_event_id
                    ]),
                    "cancel_url" => route('processPaypalCancel.plan.pricing', $eventPlanPricing->id),
                ],
                "purchase_units" => [
                    0 => [
                        "amount" => [
                            "currency_code" => $eventPlanPricing->event->priceCurrency->code,
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
                    ->route('plan.pricing.place.order', $eventPlanPricing->id)
                    ->with('error', 'Something went wrong.');
            } else {
                return redirect()
                    ->route('plan.pricing.place.order', $eventPlanPricing->id)
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


        $provider = new PayPalClient;
        $provider->setApiCredentials($this->paypalConfig());
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $eventPlanTransaction = new EventPlanTransaction();
            $eventPlanTransaction->event_plan_id = $data;
            $eventPlanTransaction->buy_user_id = Auth::guard('general')->user()->id;
            $eventPlanTransaction->author_event_id = $request->author_event_id;
            $eventPlanTransaction->paid_price = $request->paid_price;
            $eventPlanTransaction->coupon = $request->coupon_code;
            $eventPlanTransaction->discount = $request->discount;
            $eventPlanTransaction->payment_getway = $request->payment_getway;
            $eventPlanTransaction->transaction_id = $rand_string;
            $eventPlanTransaction->sold = 1;
            $eventPlanTransaction->save();

            // ----------------User Wallet balance save----------------
            $user_wallet = UserWallet::where('user_id', $eventPlanTransaction->author_event_id)->first();
            $user_wallet->balance = $user_wallet->balance + $eventPlanTransaction->paid_price;
            $user_wallet->update();

            // --------------------plans seat column update--------------------
            $planPricing = EventPlan::with('event.priceCurrency')->where('id', $data)->first();
            $planPricing->seat = $planPricing->seat - 1;
            $planPricing->update();
            return redirect()
                ->route('event.plan.pricing.place.order', $planPricing->id)
                ->with('success', 'Transaction complete.');
        } else {
            $planPricing = EventPlan::with('event.priceCurrency')->where('id', $data)->first();
            return redirect()
                ->route('event.plan.pricing.place.order', $planPricing->id)
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    public function processPaypalCancelPlanPricing(Request $request, $id)
    {
        $planPricing = EventPlan::with('event.priceCurrency')->where('id', $id)->first();
        return redirect()
            ->route('pricing.place_order', $planPricing->id)
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }


    public function paypalConfig()
    {
        $priceCurrency = PriceCurrency::first();
        $paypalPaymentGetway = AdminPaypalGetway::first();
        $config = [
            'mode'    => $paypalPaymentGetway->mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'client_id'         => $paypalPaymentGetway->client_id,
                'client_secret'     => $paypalPaymentGetway->secret_key,
                'app_id'            => $paypalPaymentGetway->app_id,
            ],
            'live' => [
                'client_id'         => $paypalPaymentGetway->client_id,
                'client_secret'     => $paypalPaymentGetway->secret_key,
                'app_id'            => $paypalPaymentGetway->app_id,
            ],
            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $priceCurrency->code,
            'notify_url'     => "", // Change this accordingly for your application.
            'locale'         => 'en_US', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
        ];

        return $config;
    }
}
