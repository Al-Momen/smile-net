<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AdminPaypalGetway;
use App\Http\Controllers\Controller;
use App\Models\AdminStripeGetway;

class AdminGetwayController extends Controller
{
    public function index()
    {
        $paypalGetway = AdminPaypalGetway::all();
        $stripeGetway = AdminStripeGetway::all();
        return view('admin.automatic-getway.getway_list',compact('paypalGetway','stripeGetway'));
    }
}
