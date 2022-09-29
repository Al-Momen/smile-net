<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminCategory;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories=AdminCategory::all();
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
        return redirect()->back()->with('success', "Category create Successfully");
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
        return redirect()->route('admin.category.index')->with('success', "Category Update Successfully");
    }

    public function destroy($id){
        $Category = AdminCategory::find($id);
        $Category->delete();
        return redirect()->back()->with('success', "Category delete Successfully");

    }
}
