<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\News;
use App\Models\AdminNews;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Database\QueryException;

class NewsController extends Controller
{

    public function news()
    {
        $data['general_news'] = AdminNews::with(['category'])->where('user_id', Auth::guard('general')->id())->where('news_type','App\Models\GeneralUser')->paginate(8);
        // Active news count
        $data['general_active_count'] = AdminNews::where('user_id', Auth::guard('general')->id())->where('news_type','App\Models\GeneralUser')->where('status',1)->count();
        // pending news count
        $data['general_pending_count'] = AdminNews::where('user_id', Auth::guard('general')->id())->where('news_type','App\Models\GeneralUser')->where('status',0)->count();
        // Total news count
        $data['general_count'] = AdminNews::where('user_id', Auth::guard('general')->id())->where('news_type','App\Models\GeneralUser')->count();
        $data['categories'] = AdminCategory::all();
        return view('frontend.deshboard.pages.news',$data);
    }
    public function storeNews(Request $request)
    {
          // dd($request->all());
          $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'category' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = new AdminNews();
            $news->user_id = Auth::guard('general')->user()->id;
            $news->news_type = get_class(Auth::guard('general')->user());
            $news->title = $request->title;
            $news->description = $request->description;
            $news->tag = $request->tag;
            $news->category_id = $request->category;
            $news->image = Generals::upload('news/', 'png', $request->image);
            $news->save();
            return redirect()->back()->with('success', "News create Successfully");
            // return response()->json([
            //     'status'=> 'success',
            //     "message"=>"Event is Created Successfully"
            // ]);
        } catch (QueryException $e) {
            // return response()->json([
            //     'errorMessage' => $event->errors()->all(),
            //     'data' => $event
            // ]);
            dd($e->getMessage());
        }
    }
    public function editNews($id)
    {     
        $news = AdminNews::where('id',$id)->first();
        $categories = AdminCategory::all();
        return view('frontend.deshboard.pages.edit_news', compact('news','categories'));
    }
    public function newsStatusEdit(Request $request, $id)
    {
        $news = AdminNews::where('id', $id)->first();
        if ($request->status == 'on') {
            $news->status = 1;
            $news->update();
            $notify[] = ['success', 'Author Wall is Active'];
            return redirect()->back()->withNotify($notify);
        } else {
            $news->status = 0;
            $news->update();
            $notify[] = ['success', 'Author Wall is Inactive'];
            return redirect()->back()->withNotify($notify);
        }
    }
    public function updateNews(Request $request, $id)
    {   
         // dd($request->all());
         $request->validate([
            'title' => 'required|min:2|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'category' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = AdminNews::where('id',$id)->first();
            $oldImage= $news->image;     
            $news->user_id = Auth::guard('general')->user()->id;
            $news->news_type = get_class(Auth::guard('general')->user());
            $news->title = $request->title;
            $news->description = $request->description;
            $news->tag = $request->tag;
            $news->category_id = $request->category;
            $news->update();
            if($request->hasFile('image')){
                $news->image = Generals::update('news/', $oldImage,'png', $request->image);
            }
            return redirect()->route('user.news')->with('success', "News Update Successfully");
            // return response()->json([
            //     'status'=> 'success',
            //     "message"=>"Event is Created Successfully"
            // ]);
        } catch (QueryException $e) {
            // return response()->json([
            //     'errorMessage' => $event->errors()->all(),
            //     'data' => $event
            // ]);
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $news = AdminNews::find($id);
        Generals::unlink('news/',$news->image);
        $news->delete();
        return redirect()->back()->with('success', "News delete Successfully");;
    }


}
