<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\News;
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
        $data['general_news'] = News::with(['category'])->where('user_id', Auth::guard('general')->id())->get();
        $data['general_count'] = News::where('user_id', Auth::guard('general')->id())->count();
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
            $news = new News();
            $news->user_id = Auth::guard('general')->user()->id;
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
        $news = News::where('id',$id)->first();
        $categories = AdminCategory::all();
        return view('frontend.deshboard.pages.edit_news', compact('news','categories'));
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
            $news = News::where('id',$id)->first();
            $oldImage= $news->image;     
            $news->user_id = Auth::guard('general')->user()->id;
            $news->title = $request->title;
            $news->description = $request->description;
            $news->tag = $request->tag;
            $news->category_id = $request->category;
            $news->image = Generals::update('news/', $oldImage,'png', $request->image);
            $news->update();
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
        $news = News::find($id);
        Generals::unlink('news/',$news->image);
        $news->delete();
        return redirect()->back()->with('success', "News delete Successfully");;
    }


}
