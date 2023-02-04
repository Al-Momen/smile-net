<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\AdminNews;
use Illuminate\Http\Request;
use App\Models\AdminCategory;
use App\Http\Helpers\Generals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class AdminNewsController extends Controller
{
    public function index()
    {
        $allNews = AdminNews::with(['category','admin'])->where('news_type','App\Models\User')->where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(10);
        $categories = AdminCategory::all();
        return view('admin.admin-news.news',compact('categories','allNews'));
    }
    public function storeNews(Request $request)
    {   

          $request->validate([
            'title' => 'required|min:2|max:255',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = new AdminNews();
            $news->user_id = Auth::user()->id;
            $news->news_type = get_class(Auth::user());
            $news->title = $request->title;
            $news->category_id = $request->category;
            $news->tag = $request->tag;
            $news->description = $request->description;
            $news->status = 1;
            $news->image = Generals::upload('news/', 'png', $request->image);
            $news->save();
            $notify[] = ['success', 'News create Successfully'];
            return redirect()->back()->withNotify($notify);
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }
    public function editNews($id)
    {     
        $news = AdminNews::where('id',$id)->first();
        $categories = AdminCategory::all();
        return view('admin.admin-news.edit_news', compact('news','categories'));
    }
    public function editStatusNews(Request $request, $id)
    {
        $news = AdminNews::where('id', $id)->first();
        if ($request->status == 'on') {
            $news-> status = 1;
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
            'category' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
            'description' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = AdminNews::where('id',$id)->first();
            $oldImage= $news->image;     
            $news->user_id = Auth::user()->id;
            $news->news_type = get_class(Auth::user());
            $news->title = $request->title;
            $news->category_id = $request->category;
            $news->tag = $request->tag;
            $news->description = $request->description;
            $news-> status = 1;  
            $news->image = Generals::update('news/', $oldImage,'png', $request->image);
            $news->update();
            if ($request->hasFile('image')) {
                $news->image = Generals::update('news/', $oldImage,'png', $request->image);
                $news->update();
            }

            $notify[] = ['success', 'Author Wall Update Successfully'];
            return redirect()->route('admin.news.index')->withNotify($notify);
        } catch (QueryException $e) {
           
            dd($e->getMessage());
        }
    }
    public function destroy($id)
    {
        $news = AdminNews::find($id);
        Generals::unlink('news/',$news->image);
        $news->delete();
        $notify[] = ['success', 'News delete Successfully'];
        return redirect()->back()->withNotify($notify); 
    }

    public function allNews()
    {
        $allNews = AdminNews::with(['category','admin.adminUser','user'])->orderBy('id','desc')->paginate(10);
        $categories = AdminCategory::all();
        return view('admin.admin-news.all_news', compact('allNews','categories'));
    }

    public function viewNews($id)
    {
        // dd('ok');
        $news = AdminNews::with(['category', 'admin'])->findOrFail($id); // relation from events table->then 
        $categories = AdminCategory::all();
        return view('admin.admin-news.view_news',compact('categories','news'));
        
    }
}
