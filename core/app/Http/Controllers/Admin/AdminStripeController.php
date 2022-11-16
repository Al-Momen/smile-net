<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminStripeGetway;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class AdminStripeController extends Controller
{
    public function index()
    {
        $adminStripe = AdminStripeGetway::first();
        return view('admin.admin-payment-getway.stripe',compact('adminStripe'));
    }
    public function UpdateSrtipe(Request $request ,$id)
    {
        $request->validate([
            'stripe_key' => 'required',
            'stripe_secret' => 'required',

        ]);
        try {
            $adminPaypal =  AdminStripeGetway::findOrFail($id);
            $adminPaypal->stripe_key = $request->stripe_key;
            $adminPaypal->stripe_secret = $request->stripe_secret;
            $adminPaypal->update();
            $notify[] = ['success', 'Stripe Update Successfully'];
        return back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
}
