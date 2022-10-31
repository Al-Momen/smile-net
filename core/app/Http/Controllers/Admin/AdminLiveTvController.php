<?php

namespace App\Http\Controllers\Admin;

use App\Models\AdminLiveTv;
use Illuminate\Http\Request;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminLiveTvController extends Controller
{
    public function index()
    {
        $allLiveTv = AdminLiveTv::with('admin')->paginate(10);
        return view('admin.admin-live-tv.index',compact('allLiveTv'));
    }
    public function storeLiveTv(Request $request)
    {
        //    dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'tv_link' => 'required',
            'tv_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'date' => 'required',
        ]);
        try {
            $liveTv = new AdminLiveTv();
            $liveTv->admin_id = Auth::user()->id;
            $liveTv->title = $request->title;
            $liveTv->tv_name = $request->tv_name;
            $liveTv->tv_link = $request->tv_link;
            $liveTv->date = $request->date;
            $liveTv->description = $request->description;
            $liveTv->image = Generals::upload('live-tv/', 'png', $request->image);
            $liveTv->save();
            $notify[] = ['success', 'Live TV create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editLiveTv($id)
    {     
        $liveTv = AdminLiveTv::where('id',$id)->first();
        return view('admin.admin-live-tv.edit_live_tv', compact('liveTv'));
    }

    public function editStatusLiveTv(Request $request, $id)
    {
        $books = AdminLiveTv::where('id', $id)->first();
        if ($request->status == 'on') {
            $books-> status = 1;
            $books->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $books->status = 0;
            $books->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateLiveTv(Request $request, $id)
    {   
         // dd($request->all());
         $request->validate([
            'title' => 'required|min:2|max:255',
            'tv_link' => 'required',
            'tv_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'date' => 'required',
        ]);
        try {

            $liveTv = AdminLiveTv::where('id',$id)->first();
            $oldImage= $liveTv->image;   
            $liveTv->admin_id = Auth::user()->id;
            $liveTv->title = $request->title;
            $liveTv->tv_name = $request->tv_name;
            $liveTv->tv_link = $request->tv_link;
            $liveTv->date = $request->date;
            $liveTv->description = $request->description;
            $liveTv->image = Generals::update('live-tv/', $oldImage,'png', $request->image);
            $liveTv->update();
            $notify[] = ['success', 'Live Tv Update Successfully'];
            return redirect()->route('admin.live.tv.index')->withNotify($notify);
        } catch (QueryException $e) {
           
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $liveTv = AdminLiveTv::find($id);
        Generals::unlink('live-tv/',$liveTv->image);
        $liveTv->delete();
        $notify[] = ['success', 'Live Tv delete Successfully'];
        return redirect()->back()->withNotify($notify); 
    }
}
