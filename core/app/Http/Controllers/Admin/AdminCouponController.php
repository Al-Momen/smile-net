<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(8);
        return view('admin.coupon.index', compact('coupons'));
    }

    public function storeCoupon(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'code' => 'required|min:2|max:9|unique:coupons',
            'price' => 'required',
        ]);
        $coupon = new Coupon();
        $coupon->name = $request->name;
        $coupon->code = $request->code;
        $coupon->discount_price = $request->price;
        $coupon->save();
        $notify[] = ['success', 'Coupon create Successfully'];
        return redirect()->back()->withNotify($notify);
        
    }

    public function editStatusCoupon( Request $request, $id)
    {
        $coupon = Coupon::where('id', $id)->first();
        if ($request->status == 'on') {
            $coupon-> status = 1;
            $coupon->update();
            $notify[] = ['success', 'Coupon Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $coupon->status = 0;
            $coupon->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        $notify[] = ['success', 'Coupon delete Successfully'];
        return redirect()->back()->withNotify($notify);

    }


}
