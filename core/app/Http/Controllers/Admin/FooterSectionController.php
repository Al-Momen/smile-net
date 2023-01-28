<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSection;
use Illuminate\Http\Request;

class FooterSectionController extends Controller
{
    public function index()
    {
        $footer = FooterSection::first();
        return view('admin.manage-section.footer',compact('footer'));
    }

    public function update(Request $request ,$id)
    {
        $request->validate([
            'heading' =>'required|string',
            'title' =>'required|string',
        ]);

        $footer = FooterSection::findOrFail($id);
        $footer->heading = $request->heading;
        $footer->title = $request->title;
        $footer->update();
        $notify[] = ['success', 'Footer update successful'];
        return back()->withNotify($notify);
       
    }
}
