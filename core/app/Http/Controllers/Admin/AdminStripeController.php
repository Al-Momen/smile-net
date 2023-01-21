<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminStripeGetway;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Http\Helpers\Generals;

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
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'stripe_key' => 'required',
            'stripe_secret' => 'required',
        ]);
        try {
            $adminStripe =  AdminStripeGetway::findOrFail($id);
            $oldImage = $adminStripe->image;
            $adminStripe->image = Generals::update('automatic-getway/', $oldImage, 'png', $request->image);
            $adminStripe->stripe_key = $request->stripe_key;
            $adminStripe->stripe_secret = $request->stripe_secret;
            $adminStripe->update();
            $notify[] = ['success', 'Stripe Update Successfully'];
        return back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
}
