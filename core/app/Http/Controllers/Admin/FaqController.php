<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(){
        $allFaq = FAQ::paginate(10);
        return view('admin.manage-section.faq.faq',compact('allFaq'));
    }

    public function storeFaq(Request $request){
        
        $request->validate([
            'question'=> 'string|required',
            'ans'=> 'string|required',
        ]);
         
        $faq = new FAQ();
        $faq->question = $request->question;
        $faq->ans = $request->ans;
        $faq->save();
        $notify[] = ['success', 'FAQ Create successful'];
        return back()->withNotify($notify);
    }

    public function editFaq(Request $request ,$id){
        
        $faq = FAQ::where('id',$id)->first();
        return view('admin.manage-section.faq.edit_faq_site',compact('faq'));
    }

    public function updateFaq(Request $request ,$id){
        
        $request->validate([
            'question'=> 'string|required',
            'ans'=> 'string|required',
        ]);
         
        $faq = FAQ::where('id',$id)->first();
        $faq->question = $request->question;
        $faq->ans = $request->ans;
        $faq->update();
        $notify[] = ['success', 'FAQ Update successful'];
        return back()->withNotify($notify);
    }

    public function destroy($id){
        $faq = FAQ::findOrFail($id);
        $faq->delete();
        $notify[] = ['success', 'FAQ delete successful'];
        return back()->withNotify($notify);
    }
}
