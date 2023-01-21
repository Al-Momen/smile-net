<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pages;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use App\Models\AdminManageSite;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

class AdminManageSiteController extends Controller
{
    public function index()
    {
        $allSiteImages = AdminManageSite::with('manageSite')->paginate(10);
        $pages = Pages::get();
        return view('admin.admin-manage-site.manage_site',compact('allSiteImages','pages'));
        
    }

    public function storeManageSite(Request $request)
    {
        //    dd($request->all());
          $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        try {
            $manageSite = new AdminManageSite();
            $manageSite->manage_site_id =  $request->pages;
            $manageSite->image = Generals::upload('manage-site/', 'png', $request->image);
            $manageSite->save();
            $notify[] = ['success', 'Manage Photo create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editManageSite($id)
    {     
        $siteImage = AdminManageSite::where('id',$id)->first();
        $pages = Pages::get();
        return view('admin.admin-manage-site.edit_manage_site',compact('siteImage','pages'));
    }
    public function editStatusManageSite(Request $request, $id)
    {
        $siteImage = AdminManageSite::where('id', $id)->first();
        if ($request->status == 'on') {
            $siteImage-> status = 1;
            $siteImage->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $siteImage->status = 0;
            $siteImage->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateManageSite(Request $request, $id)
    {   
         // dd($request->all());
         $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        try {
            $manageSite = AdminManageSite::where('id',$id)->first();
            $oldImage= $manageSite->image;     
            $manageSite->manage_site_id =  $request->pages;
            $manageSite->image = Generals::update('manage-site/', $oldImage,'png', $request->image);
            $manageSite->update();
            $notify[] = ['success', 'Manage Photo Update Successfully'];
            return redirect()->route('admin.manage.site')->withNotify($notify);
        } catch (QueryException $e) {
           
            dd($e->getMessage());
        }
    }
    public function destroyManageSite($id)
    {
         $news = AdminManageSite::find($id);
        Generals::unlink('manage-site/',$news->image);
        $news->delete();
        $notify[] = ['success', 'Manage Photo delete Successfully'];
        return redirect()->back()->withNotify($notify); 
    }
    
}
