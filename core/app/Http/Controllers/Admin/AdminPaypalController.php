<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminPaypalGetway;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Helpers\Generals;
use App\Models\Currency;
use App\Models\PriceCurrency;

class AdminPaypalController extends Controller
{
    public function index()
    {
        $adminPaypal = AdminPaypalGetway::first();
        $currency = PriceCurrency::first();
        return view('admin.admin-payment-getway.paypal',compact('adminPaypal','currency'));
    }

    public function UpdatePaypal(Request $request ,$id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'client_id' => 'required',
            'fixed_charge' => 'required',
            'percent_charge' => 'required',
            'secret_key' => 'required',
            'app_id' => 'required',
            'mode' => 'required',
        ]);
        
        try {
            $adminPaypal =  AdminPaypalGetway::findOrFail($id);
            $oldImage = $adminPaypal->image;
            $adminPaypal->client_id = $request->client_id;
            $adminPaypal->secret_key = $request->secret_key;
            $adminPaypal->app_id = $request->app_id;
            $adminPaypal->mode = $request->mode;
            $adminPaypal->update();
            if($request->hasFile('image')){
                $adminPaypal->image = Generals::update('automatic-getway/', $oldImage, 'png', $request->image);
            }
            $notify[] = ['success', 'Paypal Update Successfully'];
        return back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
       
}
