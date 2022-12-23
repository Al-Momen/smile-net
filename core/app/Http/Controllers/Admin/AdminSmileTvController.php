<?php

namespace App\Http\Controllers\Admin;

use App\Models\TicketType;
use App\Models\AdminSmileTv;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminSmileTvController extends Controller
{
    public function index()
    {
        $allSmileTv = AdminSmileTv::paginate(8);
        $categories = AdminCategory::get();
        $ticketTypes = TicketType::get();
        return view('admin.smile-tv.index',compact('allSmileTv','categories','ticketTypes'));
    }
    public function storeSmileTv(Request $request)
    {
        $request->validate([
            'title' => 'required|min:2|max:255',
            'name' => 'required',
            'category' => 'required',
            'type' => 'required',
            'date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg', 
            'mp4' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        if($request->smile_tv_link == '' && $request->mp4 == ''){
            $notify[] = ['error', 'smile_tv_link or video one field is required'];
            return redirect()->back()->withNotify($notify);
        };

        // dd($request->all());

        try {
            $smileTv = new AdminSmileTv();
            $smileTv->admin_id = Auth::user()->id;
            $smileTv->category_id = $request->category;
            $smileTv->title = $request->title;
            $smileTv->name = $request->name;
            $smileTv->type = $request->type;
            $smileTv->date = $request->date;
            $smileTv->smile_tv_link = $request->smile_tv_link;
            $smileTv->image = Generals::upload('smile-tv/', 'png', $request->image);
            $smileTv->mp4 = Generals::upload('smile-tv/video/', $request->mp4->getClientOriginalExtension(), $request->mp4);
            $smileTv->save();
            $notify[] = ['success', 'Smile-Tv Create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }


    public function editSmileTv($id)
    {
        $smileTv = AdminSmileTv::with(['category', 'ticketType'])->findOrFail($id); // relation from events table->then plans table-> then ticket_type get data
        $categories = AdminCategory::get();
        $ticketTypes = TicketType::get();
        return view('admin.smile-tv.edit_smile_tv', compact('smileTv', 'categories', 'ticketTypes'));
    }
    public function editStatusSmileTv(Request $request, $id)
    {
        
        $smileTv = AdminSmileTv::where('id', $id)->first();
        if ($request->status == 'on') {
            $smileTv-> status = 1;
            $smileTv->update();
            $notify[] = ['success', 'Admin Status is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $smileTv-> status = 0;
            $smileTv->update();
            $notify[] = ['success', 'Admin Status is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateSmileTv(Request $request, $id)
    {
        //   dd($request->all());
        $request->validate([
            'title' => 'required|min:2|max:255',
            'name' => 'required',
            'category' => 'required',
      
            'type' => 'required',
            'date' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg', 
            'mp4' => 'mimes:mp4,ogx,oga,ogv,ogg,webm,mov,mkv|max:9000000',
        ]);
        if($request->smile_tv_link == '' && $request->mp4 == ''){
            $notify[] = ['error', 'smile_tv_link or video one field is required'];
            return redirect()->back()->withNotify($notify);
        };
        try {
            $smileTv = AdminSmileTv::where('id', $id)->first();
            $oldImage = $smileTv->image;
            $oldmp4 = $smileTv->oldmp4;
            $smileTv->admin_id = Auth::user()->id;
            $smileTv->category_id = $request->category;
            $smileTv->title = $request->title;
            $smileTv->name = $request->name;
            $smileTv->type = $request->type;
            $smileTv->date = $request->date;
            $smileTv->smile_tv_link = $request->smile_tv_link;
            $smileTv->image = Generals::update('smile-tv/', $oldImage, 'png', $request->image);
            $smileTv->mp4 = Generals::update('smile-tv/video/', $oldmp4, $request->mp4->getClientOriginalExtension(), $request->mp4);
            $smileTv->update();
            $notify[] = ['success', 'Smile-Tv is Upadte Successfully'];
            return redirect()->route("admin.smile.tv.index")->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $smileTv = AdminSmileTv::find($id);
        Generals::unlink("smile-tv/", $smileTv->image);
        $smileTv->delete();
        return redirect()->back()->with('success', "Smile-Tv delete Successfully");;
    }
}
