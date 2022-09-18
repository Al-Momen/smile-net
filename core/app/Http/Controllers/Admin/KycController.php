<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KycForm;
use Illuminate\Http\Request;

class KycController extends Controller
{
    public function manageKyc()
    {
        $pageTitle = "Manage KYC Form";
        $kyc       = KycForm::latest()->get();
        $emptyMessage = "No Data Found";
        return view('admin.kyc.list', compact('pageTitle', 'kyc', 'emptyMessage'));
    }
    public function editKyc()
    {
        $pageTitle = "Edit KYC Form";
        $kyc       = KycForm::where('user_type', 'USER')->firstOrFail();
        return view('admin.kyc.edit', compact('pageTitle', 'kyc'));
    }

    public function updateKyc(Request $request)
    {
        $request->validate(
            [
                'field_name.*'   => 'sometimes|required'
            ],
            [
                'field_name.*.required' => 'All form data field is required'
            ]
        );

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $arr = [];
                $arr['field_name'] =  strtolower(str_replace(' ', '_', sanitizedParam($request->field_name[$a])));
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }

        $kyc = KycForm::findOrFail($request->id);
        $kyc->status = $request->status ? 1 : 0;
        $kyc->form_data = $input_form;
        $kyc->save();
        $notify[] = ['success', 'Kyc form updated'];
        return back()->withNotify($notify);
    }
}
