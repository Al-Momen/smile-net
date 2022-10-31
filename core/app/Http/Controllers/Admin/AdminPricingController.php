<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketType;
use App\Models\AdminPricing;
use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminPricingController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::get();
        $priceCurrency = PriceCurrency::first();
        $allPricing = AdminPricing::with(['ticketType', 'priceCurrency', 'admin'])->paginate(8);
        return view('admin.admin-pricing.index',compact('allPricing','priceCurrency','ticketTypes'));
    }
    public function storePricing(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'price_currency_id' => 'required',
            'price' => 'required',
        ]);
        $pricing = new AdminPricing();
        $pricing->name = $request->name;
        $pricing->admin_id = Auth::user()->id;
        $pricing->ticket_type_id = $request->ticket_type_id;
        $pricing->price_currency_id = $request->price_currency_id;
        $pricing->price = $request->price;
        $pricing->save();
        $notify[] = ['success', 'Pricing create Successfully'];
        return redirect()->back()->withNotify($notify);
    }
    public function editPricing($id)
    {
        $pricing = AdminPricing::where('id', $id)->first();
        $ticketTypes = TicketType::get();
        $priceCurrency = PriceCurrency::first();
        return view('admin.admin-pricing.edit_pricing', compact('pricing','ticketTypes','priceCurrency'));
    }
    public function editStatusPricing(Request $request, $id)
    {
        $pricing = AdminPricing::where('id', $id)->first();
        if ($request->status == 'on') {
            $pricing-> status = 1;
            $pricing->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $pricing->status = 0;
            $pricing->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updatePricing(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'ticket_type_id' => 'required',
            'price_currency_id' => 'required',
            'price' => 'required',
        ]);
        $pricing =  AdminPricing::where('id', $id)->first();
        $pricing->name = $request->name;
        $pricing->admin_id = Auth::user()->id;
        $pricing->ticket_type_id = $request->ticket_type_id;
        $pricing->price_currency_id = $request->price_currency_id;
        $pricing->price = $request->price;
        $pricing->update();
        $notify[] = ['success', 'Pricing Update Successfully'];
        return redirect()->route('admin.pricing.index')->withNotify($notify);
    }
    public function destroy($id)
    {
        $pricing = AdminPricing::find($id);
        $pricing->delete();
        $notify[] = ['success', 'Pricing delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }
}
