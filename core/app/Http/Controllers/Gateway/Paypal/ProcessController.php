<?php

namespace App\Http\Controllers\Gateway\Paypal;

use App\Models\TiktokBuy;
use App\Models\GeneralSetting;
use App\Models\BookTransaction;
use App\Models\TicketTypeDetails;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BuyController;
use App\Http\Controllers\Gateway\PaymentController;
use App\Http\Controllers\Frontend\BookBuyController;
use App\Http\Controllers\Frontend\TicketBuyController;
use App\Models\PriceCurrency;

class ProcessController extends Controller
{

    public static function buyBookProcess($bookTransaction)
    {
        $basic =  GeneralSetting::first();
        $base_currency =  PriceCurrency::first();
        $paypalAcc = json_decode($bookTransaction->gatewayCurrency()->gateway_parameter);
        $val['cmd'] = '_xclick';
        $val['business'] = trim($paypalAcc->paypal_email);
        $val['cbt'] = $basic->sitename;
        $val['currency_code'] = "$base_currency->code";
        $val['quantity'] = 1;
        $val['item_name'] = "Payment To $basic->sitename Account";
        $val['custom'] = "$bookTransaction->transaction_id";
        $val['amount'] = round($bookTransaction->final_amo,2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('buy.book.ipn.'.$bookTransaction->gateway->alias);
        $send['val'] = $val;
        $send['view'] = 'payment.redirect';
        $send['method'] = 'post';
        // $send['url'] = 'https://www.sandbox.paypal.com/'; // use for sandbod text
        $send['url'] = 'https://www.paypal.com/cgi-bin/webscr';
        return json_encode($send);
    }
    public static function processApi($coinBuy)
    {
        $basic =  GeneralSetting::first();
        $paypalAcc = json_decode($coinBuy->gatewayCurrency()->gateway_parameter);

        $val['cmd'] = '_xclick';
        $val['business'] = trim($paypalAcc->paypal_email);
        $val['cbt'] = $basic->sitename;
        $val['currency_code'] = "$coinBuy->method_currency";
        $val['quantity'] = 1;
        $val['item_name'] = "Payment To $basic->sitename Account";
        $val['custom'] = "$coinBuy->trx";
        $val['amount'] = round($coinBuy->final_amo,2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('ipn.'.$coinBuy->gateway->alias);
        $send['val'] = $val;
        $send['view'] = 'user.payment.redirect';
        $send['method'] = 'post';
        // $send['url'] = 'https://www.sandbox.paypal.com/'; // use for sandbod text
        $send['url'] = 'https://www.paypal.com/cgi-bin/webscr';
        $send['payment_url'] = 'https://paypal.com/cgi-bin/webscr?cmd=_xclick&business='.trim($paypalAcc->paypal_email).'&cbt='.$basic->sitename.'&currency_code='.$val['currency_code'].'&quantity='.$val['quantity'].'&item_name='.$val['item_name'].'&custom='.$val['custom'].'&amount='.$val['amount'].'&return='.$val['return'].'&cancel_return='.$val['cancel_return'].'&notify_url='.$val['notify_url'];
        return json_encode($send);
    }

    public function buyBookProcessIpn()
    {
        // dd('ok');
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        $req = 'cmd=_notify-validate';
        foreach ($myPost as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
            $details[$key] = $value;
        }
        
        // $paypalURL = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr?"; // use for sandbox text
        $paypalURL = "https://ipnpb.paypal.com/cgi-bin/webscr?";
        $callUrl = $paypalURL . $req;
        $verify = curlContent($callUrl);

        if ($verify == "VERIFIED") {
            $bookTransaction = BookTransaction::where('transaction_id', $_POST['custom'])->orderBy('id', 'DESC')->first();
            $bookTransaction->detail = $details;
            $bookTransaction->save();

            if ($_POST['mc_gross'] == $bookTransaction->final_amo && $bookTransaction->status == '0') {
                BookBuyController::userDataUpdate($bookTransaction->transaction_id);
            }
        }
    }

    public static function buyTicketProcess($ticketTypeDetails)
    {
        $base_currency =  PriceCurrency::first();
        $basic =  GeneralSetting::first();
        $paypalAcc = json_decode($ticketTypeDetails->gatewayCurrency()->gateway_parameter);
        $val['cmd'] = '_xclick';
        $val['business'] = trim($paypalAcc->paypal_email);
        $val['cbt'] = $basic->sitename;
        $val['currency_code'] = "$base_currency->code";
        $val['quantity'] = 1;
        $val['item_name'] = "Payment To $basic->sitename Account";
        $val['custom'] = "$ticketTypeDetails->transaction_id";
        $val['amount'] = round($ticketTypeDetails->final_amo,2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('buy.ticket.ipn.'.$ticketTypeDetails->gateway->alias);
        $send['val'] = $val;
        $send['view'] = 'payment.redirect';
        $send['method'] = 'post';
        // $send['url'] = 'https://www.sandbox.paypal.com/'; // use for sandbod text
        $send['url'] = 'https://www.paypal.com/cgi-bin/webscr';
        return json_encode($send);
    }

    public function buyTicketProcessIpn()
    {
        // dd('ok');
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        $req = 'cmd=_notify-validate';
        foreach ($myPost as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
            $details[$key] = $value;
        }
        
        // $paypalURL = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr?"; // use for sandbox text
        $paypalURL = "https://ipnpb.paypal.com/cgi-bin/webscr?";
        $callUrl = $paypalURL . $req;
        $verify = curlContent($callUrl);

        if ($verify == "VERIFIED") {
            $ticketTypeDetails = TicketTypeDetails::where('transaction_id', $_POST['custom'])->orderBy('id', 'DESC')->first();
            $ticketTypeDetails->detail = $details;
            $ticketTypeDetails->save();
            if ($_POST['mc_gross'] == $ticketTypeDetails->final_amo && $ticketTypeDetails->status == '0') {
                TicketBuyController::userDataUpdate($ticketTypeDetails->transaction_id);
            }
        }
    }


    public static function buyEventPlanProcess($eventPlanDetails)
    {
        $base_currency =  PriceCurrency::first();
        $basic =  GeneralSetting::first();
        $paypalAcc = json_decode($eventPlanDetails->gatewayCurrency()->gateway_parameter);
        $val['cmd'] = '_xclick';
        $val['business'] = trim($paypalAcc->paypal_email);
        $val['cbt'] = $basic->sitename;
        $val['currency_code'] = "$base_currency->code";
        $val['quantity'] = 1;
        $val['item_name'] = "Payment To $basic->sitename Account";
        $val['custom'] = "$eventPlanDetails->transaction_id";
        $val['amount'] = round($eventPlanDetails->final_amo,2);
        $val['return'] = route(gatewayRedirectUrl(true));
        $val['cancel_return'] = route(gatewayRedirectUrl());
        $val['notify_url'] = route('buy.ticket.ipn.'.$eventPlanDetails->gateway->alias);
        $send['val'] = $val;
        $send['view'] = 'payment.redirect';
        $send['method'] = 'post';
        // $send['url'] = 'https://www.sandbox.paypal.com/'; // use for sandbod text
        $send['url'] = 'https://www.paypal.com/cgi-bin/webscr';
        return json_encode($send);
    }

    public function buyEventPlanProcessIpn()
    {
        // dd('ok');
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }

        $req = 'cmd=_notify-validate';
        foreach ($myPost as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "&$key=$value";
            $details[$key] = $value;
        }
        
        // $paypalURL = "https://ipnpb.sandbox.paypal.com/cgi-bin/webscr?"; // use for sandbox text
        $paypalURL = "https://ipnpb.paypal.com/cgi-bin/webscr?";
        $callUrl = $paypalURL . $req;
        $verify = curlContent($callUrl);

        if ($verify == "VERIFIED") {
            $ticketTypeDetails = TicketTypeDetails::where('transaction_id', $_POST['custom'])->orderBy('id', 'DESC')->first();
            $ticketTypeDetails->detail = $details;
            $ticketTypeDetails->save();

            if ($_POST['mc_gross'] == $ticketTypeDetails->final_amo && $ticketTypeDetails->status == '0') {
                TicketBuyController::userDataUpdate($ticketTypeDetails->transaction_id);
            }
        }
    }
}
