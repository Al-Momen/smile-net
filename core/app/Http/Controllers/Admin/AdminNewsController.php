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
        $allNews = AdminNews::with(['category','admin'])->paginate(10);
        $categories = AdminCategory::all();
        return view('admin.admin-news.news',compact('categories','allNews'));
    }
    public function storeNews(Request $request)
    {
        //    dd($request->all());
          $request->validate([
            'title' => 'required|min:2|max:255',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = new AdminNews();
            $news->admin_id = Auth::user()->id;
            $news->title = $request->title;
            $news->category_id = $request->category;
            $news->tag = $request->tag;
            $news->description = $request->description;
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
        $books = AdminNews::where('id', $id)->first();
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
    public function updateNews(Request $request, $id)
    {   
         // dd($request->all());
         $request->validate([
            'title' => 'required|min:2|max:255',
            'category' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'description' => 'required',
            'tag' => 'required',
        ]);
        try {
            $news = AdminNews::where('id',$id)->first();
            $oldImage= $news->image;     
            $news->admin_id = Auth::guard('general')->user()->id;
            $news->title = $request->title;
            $news->category_id = $request->category;
            $news->tag = $request->tag;
            $news->description = $request->description;
            $news->image = Generals::update('news/', $oldImage,'png', $request->image);
            $news->update();
            $notify[] = ['success', 'News Update Successfully'];
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
}
