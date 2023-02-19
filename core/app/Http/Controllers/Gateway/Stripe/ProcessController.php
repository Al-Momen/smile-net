<?php

namespace App\Http\Controllers\Gateway\Stripe;

use Stripe\Token;
use Stripe\Charge;
use Stripe\Stripe;
use App\Models\TiktokBuy;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Models\GeneralSetting;
use App\Models\BookTransaction;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;
use App\Models\EventPlanTransaction;
use App\Http\Controllers\BuyController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Api\User\BuyCoinController;
use App\Http\Controllers\Frontend\BookBuyController;
use App\Http\Controllers\Frontend\TicketBuyController;
use App\Http\Controllers\Frontend\EventPlanBuyController;

class ProcessController extends Controller
{

    /*
     * Stripe Gateway
     */
    // _______________________________buy book payment process_____________________________________
    public static function buyBookProcess($bookTransaction)
    {
        $alias = $bookTransaction->gateway->alias;
        $send['track'] = $bookTransaction->transaction_id;
        $send['view'] = 'payment.' . $alias;
        $send['method'] = 'post';
        $send['url'] = route('buy.book.ipn.' . $alias);

        return json_encode($send);
    }
    public function buyBookProcessIpn(Request $request)
    {
        $track = Session::get('Track');
        $base_currency = PriceCurrency::first();
        $bookTransaction = BookTransaction::where('transaction_id', $track)->orderBy('id', 'DESC')->first();
        if ($bookTransaction->status == 1) {
            $notify[] = ['error', 'Invalid request.'];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        $this->validate($request, [
            'cardNumber' => 'required',
            'cardExpiry' => 'required',
            'cardCVC' => 'required',
        ]);
        $cc = $request->cardNumber;
        $exp = $request->cardExpiry;
        $cvc = $request->cardCVC;

        $exp = $pieces = explode("/", $_POST['cardExpiry']);
        $emo = trim($exp[0]);
        $eyr = trim($exp[1]);
        $cnts = round($bookTransaction->final_amo, 2) * 100;

        $stripeAcc = json_decode($bookTransaction->gatewayCurrency()->gateway_parameter);

        Stripe::setApiKey($stripeAcc->secret_key);

        Stripe::setApiVersion("2020-03-02");

        try {
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            try {
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => $base_currency->code,
                    'amount' => $cnts,
                    'description' => 'item',
                )); 

                if ($charge['status'] == 'succeeded') {

                    BookBuyController::userDataUpdate($bookTransaction->transaction_id);

                    $notify[] = ['success', 'Your Payment Successful'];
                    return redirect()->route('place_order', $bookTransaction->book_id)->withNotify($notify);
                }
            } catch (\Exception $e) {
                $notify[] = ['error', $e->getMessage()];
            }
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
        }

        return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
    }

    public static function processApi($bookTransaction)
    {
        $alias = $coinBuy->gateway->alias;
        $send['track'] = $coinBuy->trx;
        $card = [
            [
                'field_name' => "name",
                'label_name' => "Name",
            ],
            [
                'field_name' => "cardNumber",
                'label_name' => "Card Number",
            ],
            [
                'field_name' => "cardExpiry",
                'label_name' => "Expire Date EX.(12/2024)",
            ],
            [
                'field_name' => "cardCVC",
                'label_name' => "CVC Code",
            ],
        ];
        $card2 = (array) $card;
        $send['input_field'] =  $card2;
        $send['method'] = 'post';
        $send['url'] = route('ipn.api.' . $alias);
        return json_encode($send);
    }
    public function ipnApi(Request $request)
    {

        $rules = [
            'track' => 'required',
            'cardNumber' => 'required',
            'cardExpiry' => 'required',
            'cardCVC' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $error =  ['error' => $validator->errors()->all()];
            return ResponseHelper::validation($error);
        }
        $track =  $request->track;

        $coinBuy = TiktokBuy::where('trx', $track)->orderBy('id', 'DESC')->first();
        if ($coinBuy->status == 1) {
            $error = ['error' => ['Invalid request']];
            return ResponseHelper::error($error);
        }


        $cc = $request->cardNumber;
        $exp = $request->cardExpiry;
        $cvc = $request->cardCVC;

        $exp = explode("/", $request->cardExpiry);
        $emo = trim($exp[0]);
        $eyr = trim($exp[1]);
        $cnts = round($coinBuy->final_amo, 2) * 100;

        $stripeAcc = json_decode($coinBuy->gatewayCurrency()->gateway_parameter);


        Stripe::setApiKey($stripeAcc->secret_key);

        Stripe::setApiVersion("2020-03-02");

        try {
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            try {
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => $coinBuy->method_currency,
                    'amount' => $cnts,
                    'description' => 'item',
                ));

                if ($charge['status'] == 'succeeded') {
                    BuyController::userDataUpdate($coinBuy->trx);
                    $message =  ['success' => ['Payment successfully']];
                    return ResponseHelper::onlysuccess($message);
                }
            } catch (\Exception $e) {

                $error = ['error' => [$e->getMessage]];
                return ResponseHelper::error($error);
            }
        } catch (\Exception $e) {
            $error = ['error' => [$e->getMessage]];
            return ResponseHelper::error($error);
        }
    }

    // _______________________________buy ticket payment process_____________________________________
    public static function buyTicketProcess($ticketTypeDetails)
    {

        $alias = $ticketTypeDetails->gateway->alias;
        $send['track'] = $ticketTypeDetails->transaction_id;

        $send['view'] = 'payment.' . $alias;
        $send['method'] = 'post';
        $send['url'] = route('buy.ticket.ipn.' . $alias);


        return json_encode($send);
    }
    public function buyTicketProcessIpn(Request $request)
    {
        $track = Session::get('Track');
        $base_currency = PriceCurrency::first();
        $ticketTypeDetails = TicketTypeDetails::where('transaction_id', $track)->orderBy('id', 'DESC')->first();
        if ($ticketTypeDetails->status == 1) {
            $notify[] = ['error', 'Invalid request.'];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        
        $this->validate($request, [
            'cardNumber' => 'required',
            'cardExpiry' => 'required',
            'cardCVC' => 'required',
        ]);

        $cc = $request->cardNumber;
        $exp = $request->cardExpiry;
        $cvc = $request->cardCVC;

        $exp = $pieces = explode("/", $_POST['cardExpiry']);
        $emo = trim($exp[0]);
        $eyr = trim($exp[1]);
        $cnts = round($ticketTypeDetails->final_amo, 2) * 100;

        $stripeAcc = json_decode($ticketTypeDetails->gatewayCurrency()->gateway_parameter);

        Stripe::setApiKey($stripeAcc->secret_key);

        Stripe::setApiVersion("2020-03-02");

        try {
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            try {
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => $base_currency->code,
                    'amount' => $cnts,
                    'description' => 'item',
                ));
                if ($charge['status'] == 'succeeded') {
                    
                    TicketBuyController::userDataUpdate($ticketTypeDetails->transaction_id);
                    
                    $notify[] = ['success', 'Payment captured successfully.'];
                    return redirect()->route(gatewayRedirectUrl(true))->withNotify($notify);
                }
            } catch (\Exception $e) {
                $notify[] = ['error', $e->getMessage()];
            }
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
        }

        return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
    }



    // _______________________________buy event plan payment process_____________________________________
    public static function buyEventPlanProcess($eventPlanDetails)
    {
        $alias = $eventPlanDetails->gateway->alias;
        $send['track'] = $eventPlanDetails->transaction_id;

        $send['view'] = 'payment.' . $alias;
        $send['method'] = 'post';
        $send['url'] = route('buy.event.plan.ipn.' . $alias);

        return json_encode($send);
    }
    public function buyEventPlanProcessIpn(Request $request)
    {
        $track = Session::get('Track');
        $base_currency = PriceCurrency::first();
        $eventPlanDetails = EventPlanTransaction::where('transaction_id', $track)->orderBy('id', 'DESC')->first();
        if ($eventPlanDetails->status == 1) {
            $notify[] = ['error', 'Invalid request.'];
            return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
        }
        $this->validate($request, [
            'cardNumber' => 'required',
            'cardExpiry' => 'required',
            'cardCVC' => 'required',
        ]);

        $cc = $request->cardNumber;
        $exp = $request->cardExpiry;
        $cvc = $request->cardCVC;

        $exp = $pieces = explode("/", $_POST['cardExpiry']);
        $emo = trim($exp[0]);
        $eyr = trim($exp[1]);
        $cnts = round($eventPlanDetails->final_amo, 2) * 100;

        $stripeAcc = json_decode($eventPlanDetails->gatewayCurrency()->gateway_parameter);

        Stripe::setApiKey($stripeAcc->secret_key);

        Stripe::setApiVersion("2020-03-02");

        try {
            $token = Token::create(array(
                "card" => array(
                    "number" => "$cc",
                    "exp_month" => $emo,
                    "exp_year" => $eyr,
                    "cvc" => "$cvc"
                )
            ));
            try {
                $charge = Charge::create(array(
                    'card' => $token['id'],
                    'currency' => $base_currency->code,
                    'amount' => $cnts,
                    'description' => 'item',
                ));

                if ($charge['status'] == 'succeeded') {
                    EventPlanBuyController::userDataUpdate($eventPlanDetails->transaction_id);
                    $notify[] = ['success', 'Payment captured successfully.'];

                    // return redirect()->route(gatewayRedirectUrl(true))->withNotify($notify);
                    return redirect()->route('event.plan.pricing.place.order', $eventPlanDetails->event_plan_id)->withNotify($notify);
                }
            } catch (\Exception $e) {
                $notify[] = ['error', $e->getMessage()];
            }
        } catch (\Exception $e) {
            $notify[] = ['error', $e->getMessage()];
        }

        return redirect()->route(gatewayRedirectUrl())->withNotify($notify);
    }
}
