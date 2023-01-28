<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PriceCurrency;
use App\Http\Helpers\Generals;
use App\Rules\FileTypeValidate;
use App\Models\AdminManualGetway;
use App\Http\Controllers\Controller;
use App\Models\AdminBuyManualGetway;
use App\Models\AdminBuyManualGetways;
use Illuminate\Support\Facades\Auth;

class ManualPaymentGetwayController extends Controller
{
    public function index()
    {
        
        $manualPayment = AdminManualGetway::orderBy('id', 'desc')->paginate('10');
        return view('admin.admin-manual-payment-getway.manual', compact('manualPayment'));
    }

    public function addPayment()
    {
        $currency = PriceCurrency::get();
        return view('admin.admin-manual-payment-getway.add_manual_payment', compact('currency'));
    }


    public function store(Request $request)
    {
        
        $request->validate([
            'gatway_name'    => 'required|max:60',
            'image'          => ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'currency_code'  => 'required',
            'minium_amount'  => 'required|numeric|gt:0',
            'maximum_amount' => 'required|numeric|gt:' . $request->minium_amount,
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'description'    => 'required|max:64000',
            'field_name.*'   => 'sometimes|required'
        ], [
            'field_name.*.required' => 'All field is required',
        ]);

        $lastMethod = AdminManualGetway::manual()->orderBy('id', 'desc')->first();


        $methodCode = 1000;
        if ($lastMethod) {
            $methodCode = $lastMethod->code + 1;
        }
        $filename = '';
        $path = imagePath()['gateway']['path'];
        $size = imagePath()['gateway']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $inputForm = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = array();
                $arr['field_level'] = trim($request->field_name[$a]);
                $arr['field_name'] = strtolower(str_replace(' ', '_', trim($request->field_name[$a])));
                $arr['field_type'] = $request->field_type[$a];
                $arr['field_validation'] = $request->field_validation[$a];
                $inputForm[$arr['field_name']] = $arr;
            }
        }
        // dd($inputForm);
        $method = new AdminManualGetway();
        $method->name = $request->gatway_name;
        $method->admin_id = Auth::user()->id;
        $method->currency_id = $request->currency_code;
        $method->code = $methodCode;
        $method->alias = strtolower(trim(str_replace(' ', '_', $request->name)));
        $method->minium_amount = $request->minium_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->image = $filename;
        $method->status = 0;
        $method->user_data = json_encode($inputForm);
        $method->description = $request->description;
        $method->save();
        $notify[] = ['success', $method->name . 'Manual gateway has been added.'];
        return redirect()->route('admin.manual.paymentgetway.view')->withNotify($notify);
    }


    public function edit($id)
    {
        
        $manual_gateway = AdminManualGetway::with('currency')->findOrFail($id);
        $currency = PriceCurrency::get();
        return view('admin.admin-manual-payment-getway.edit_manual_payment', compact('manual_gateway','currency'));
    }


    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'gatway_name'    => 'required|max:60',
            // 'image'          => ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'currency_code'  => 'required',
            'minium_amount'  => 'required|numeric|gt:0',
            'maximum_amount' => 'required|numeric|gt:' . $request->minium_amount,
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'description'    => 'required|max:64000',
            'field_name.*'   => 'sometimes|required'
        ], [
            'field_name.*.required' => 'All field is required',
        ]);
        $method= AdminManualGetway::manual()->findOrFail($id);
        

        $filename = $method->image;

        $path = imagePath()['gateway']['path'];
        $size = imagePath()['gateway']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $inputForm = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = array();
                $arr['field_level'] = trim($request->field_name[$a]);
                $arr['field_name'] = strtolower(str_replace(' ', '_', trim($request->field_name[$a])));
                $arr['field_type'] = $request->field_type[$a];
                $arr['field_validation'] = $request->field_validation[$a];
                $inputForm[$arr['field_name']] = $arr;
            }
        }

       
        $method->name = $request->gatway_name;
        $method->admin_id = Auth::user()->id;
        $method->currency_id = $request->currency_code;
        $method->alias = strtolower(trim(str_replace(' ', '_', $request->name)));
        $method->minium_amount = $request->minium_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->image = $filename;
        $method->status = $method->status == 1 ? 1 : 0;
        $method->user_data = json_encode($inputForm);
        $method->description = $request->description;
        $method->update();
  
        $notify[] = ['success', $method->name . ' Manual gateway has been updated.'];
        return back()->withNotify($notify);
    }




    public function manualGetwayStatusEdit(Request $request, $id)
    {
        $manualgetway = AdminManualGetway::where('id', $id)->first();
        if ($request->status == 'on') {
            $manualgetway->status = 1;
            $manualgetway->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $manualgetway->status = 0;
            $manualgetway->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function destroy($id)
    {
        $manualgetway = AdminManualGetway::find($id);
        Generals::unlink('manual-getway/', $manualgetway->image);
        $manualgetway->delete();
        $notify[] = ['success', 'Manual getway delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }


    // -------------------------------Buy manual getWay -------------------------------
    public function buyManualGetway(Request $request)
    {
        $manualPayment = AdminBuyManualGetway::paginate('10');
        return view('admin.admin-buy-manual-getway.manual', compact('manualPayment'));
    }
    public function buyManualAdd()
    {
        $currency = PriceCurrency::get();
        return view('admin.admin-buy-manual-getway.add_manual_payment', compact('currency'));
    }

    public function buyManualStore(Request $request)
    {
        

        $request->validate([
            'gatway_name'    => 'required|max:60',
            'image'          => ['required', 'image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'currency_code'  => 'required',
            'minium_amount'  => 'required|numeric|gt:0',
            'maximum_amount' => 'required|numeric|gt:' . $request->minium_amount,
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'description'    => 'required|max:64000',
            'field_name.*'   => 'sometimes|required'
        ], [
            'field_name.*.required' => 'All field is required',
        ]);

        $lastMethod = AdminBuyManualGetway::manual()->orderBy('id', 'desc')->first();


        $methodCode = 1100;
        if ($lastMethod) {
            $methodCode = $lastMethod->code + 1;
        }
        if ($request->hasFile('image')) {
            try {
                $filename = Generals::upload('manual-getway/', 'png', $request->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }
        $inputForm = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = array();
                $arr['field_level'] = trim($request->field_name[$a]);
                $arr['field_name'] = strtolower(str_replace(' ', '_', trim($request->field_name[$a])));
                $arr['field_type'] = $request->field_type[$a];
                $arr['field_validation'] = $request->field_validation[$a];
                $inputForm[$arr['field_name']] = $arr;
            }
        }
        // dd($inputForm);
        $method = new AdminBuyManualGetway();
        $method->name = $request->gatway_name;
        $method->currency_id = $request->currency_code;
        $method->code = $methodCode;
        $method->alias = strtolower(trim(str_replace(' ', '_', $request->name)));
        $method->minium_amount = $request->minium_amount;
        $method->maximum_amount = $request->maximum_amount;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->image = $filename;
        $method->status = 0;
        $method->user_data = json_encode($inputForm);
        $method->description = $request->description;
        $method->save();
        $notify[] = ['success', $method->name . 'Manual gateway has been added.'];
        return redirect()->route('admin.buy.manual.paymentgetway.addpayment')->withNotify($notify);
    }

    public function buyManualGetwayStatusEdit(Request $request, $id)
    {
        $manualgetway = AdminBuyManualGetway::where('id', $id)->first();
        if ($request->status == 'on') {
            $manualgetway->status = 1;
            $manualgetway->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $manualgetway->status = 0;
            $manualgetway->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }

    public function buyGetwayDestroy($id)
    {
        $manualgetway = AdminBuyManualGetway::find($id);
        Generals::unlink('manual-getway/', $manualgetway->image);
        $manualgetway->delete();
        $notify[] = ['success', 'Manual getway delete Successfully'];
        return redirect()->back()->withNotify($notify);
    }

}
