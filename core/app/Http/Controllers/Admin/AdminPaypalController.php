<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminPaypalGetway;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class AdminPaypalController extends Controller
{
    public function index()
    {
        $adminPaypal = AdminPaypalGetway::first();
        return view('admin.admin-payment-getway.paypal',compact('adminPaypal'));
    }

    public function UpdatePaypal(Request $request ,$id)
    {
        $request->validate([
            'client_id' => 'required',
            'secret_key' => 'required',
            'app_id' => 'required',
            'mode' => 'required',
        ]);
        try {
            $adminPaypal =  AdminPaypalGetway::findOrFail($id);
            $adminPaypal->client_id = $request->client_id;
            $adminPaypal->secret_key = $request->secret_key;
            $adminPaypal->app_id = $request->app_id;
            $adminPaypal->mode = $request->mode;
            $adminPaypal->update();
            $notify[] = ['success', 'Paypal Update Successfully'];
        return back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
       
}
