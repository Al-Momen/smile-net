<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories=AdminCategory::paginate(10);
        return view('admin.category.index',compact('categories'));
    }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:4|max:255',
        ]);
        $category = new AdminCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();
        $notify[] = ['success', 'Category Create Successfully'];
        return redirect()->back()->withNotify($notify);
    }

    public function editCategory($id)
    {
       $category= AdminCategory::where('id',$id)->first();
    //    dd($category);
       return view('admin.category.edit_category',compact('category'));
    }

    public function updateCategory(Request $request ,$id)
    {
        $request->validate([
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:4|max:255',
        ]);
        $category =  AdminCategory::where('id',$id)->first();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->update();
        $notify[] = ['success', 'Category Update Successfully'];
        return redirect()->route('admin.category.index')->withNotify($notify);
        
    }

    public function destroy($id){
        $Category = AdminCategory::find($id);
        $Category->delete();
        $notify[] = ['success', 'Category delete Successfully'];
        return redirect()->back()->withNotify($notify);  
    }
}
