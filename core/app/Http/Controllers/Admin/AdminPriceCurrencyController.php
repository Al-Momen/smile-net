<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PriceCurrency;
use Illuminate\Http\Request;

class AdminPriceCurrencyController extends Controller
{
    public function index()
    {
        $priceCurrencies = PriceCurrency::paginate(8);
        return view('admin.price-currency.index', compact('priceCurrencies'));
    }

    public function storeCurrency(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:255',
            'symbol' => 'required',
        ]);
        $currency = new PriceCurrency();
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->save();
        $notify[] = ['success', 'Currency create Successfully'];
        return redirect()->back()->withNotify($notify);
        
    }

    public function editCurrency($id)
    {
        $currency = PriceCurrency::where('id', $id)->first();
        //    dd($category);
        return view('admin.price-currency.edit-price', compact('currency'));
    }

    public function updateCurrency(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:255',
            'symbol' => 'required',
        ]);
        $currency =  PriceCurrency::where('id', $id)->first();
        $currency->name = $request->name;
        $currency->code = $request->code;
        $currency->symbol = $request->symbol;
        $currency->update();
        $notify[] = ['success', 'Currency Update Successfully'];
        return redirect()->route('admin.price.index')->withNotify($notify);
        
    }

}
