<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\BookTransaction;
use App\Http\Controllers\Controller;
use App\Models\AdminBuyManualGetway;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Support\Facades\Auth;

class UserBuyManualController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $requestData = $request->all();
        $requestData = (object) $requestData;
        $manualGetways = AdminBuyManualGetway::where('status', 1)->get();
        return view('frontend.pages.buy-manual-getway.buy_manual', compact('manualGetways', 'requestData'));
    }
    public function buyPricingRequest(Request $request)
    {
        
        $request->validate([
            'method_code' => 'required|integer',
            'book_id' => 'required|integer',
            'paid_price' => 'required',
            'payment_getway' => 'required',
        ]);
        $gateway = AdminBuyManualGetway::where('code', $request->method_code)->first();

        // $request->validate([
        //     'amount' => 'required|gte:' . $gateway->minium_amount,
        //     'amount' => 'required|lte:' . $gateway->maximum_amount,
        // ]);
        $gateway_parameters =  json_decode($gateway->user_data);

        $validation_rules = [];
        foreach ($gateway_parameters as $item) {
            $validation_rules[$item->field_name] = $item->field_validation;
        }
        // dd($validation_rules);
        $validated = $request->validate($validation_rules);
        // dd($validated);
        $set_user_data = [];
        foreach ($gateway_parameters as $item) {
            $set_user_data[$item->field_name] = [
                'field_lavel' => $item->field_level,
                'field_type' => $item->field_type,
                'value'     => $validated[$item->field_name],
            ];
        }
        // dd($set_user_data);
        $set_user_data = json_encode($set_user_data);
        $book = Book::where('id', $request->book_id)->first();
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
       
        try {
            $boolTransaction =  new BookTransaction;
            $boolTransaction->book_id = $book->id;
            $boolTransaction->author_book_id = $book->author_book_id;
            $boolTransaction->author_book_type = $book->author_book_type;
            $boolTransaction->buy_user_id = Auth::guard('general')->user()->id;
            $boolTransaction->paid_price = $request->paid_price;
            $boolTransaction->coupon = $request->coupon_code;
            $boolTransaction->method_code = $request->method_code;
            $boolTransaction->payment_getway = $request->payment_getway;
            $boolTransaction->discount = $request->discount;
            $boolTransaction->transaction_id = $rand_string;
            $boolTransaction->sold = 1;
            $boolTransaction->save();
            
            return redirect()->route('place_order',$book->id)->with('success', 'Buy book manual request successfully');

        } catch (QueryBuilder $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
