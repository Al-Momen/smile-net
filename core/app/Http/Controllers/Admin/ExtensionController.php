<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    public function index()
    {
        $pageTitle = 'Extensions';
        $extensions = Extension::orderBy('status','desc')->get();
        $emptyMessage = "No Extension Found!";
        return view('admin.extension.index', compact('pageTitle', 'extensions','emptyMessage'));
    }

    public function update(Request $request, $id)
    {
        $extension = Extension::findOrFail($id);
        foreach ($extension->shortcode as $key => $val) {
            $validation_rule = [$key => 'required'];
        }
        $request->validate($validation_rule);
        $shortcode = json_decode(json_encode($extension->shortcode), true);
        foreach ($shortcode as $key => $code) {
            $shortcode[$key]['value'] = $request->$key;
        }

        $extension->shortcode = $shortcode;
        $extension->save();
        $notify[] = ['success', $extension->name . ' has been updated'];
        return redirect()->route('admin.setting.extensions.index')->withNotify($notify);
    }

    public function statusChange(Request $request)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Extension::where('id', $data['item_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'item_id' => $data['item_id']]);
        }
    }
}
