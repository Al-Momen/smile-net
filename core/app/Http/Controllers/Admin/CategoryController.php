<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $data['title'] = "Category";
        $data['categories'] = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', $data);
    }
    public function addEditCat(Request $request, $id = null)
    {
        if ($id == "") {
            $category = new Category();
            $title = "New Category";
            $buttonText = "Save";
            $message = "Category saved successfully";
        } else {
            //Update code
            $category = Category::findOrFail($id);
            $title = "Update Category";
            $buttonText = "Update";
            $message = "Category updated successfully";
        }
        if ($request->isMethod('post')) {
            $dataSet = $request->all();
            $category->title = $dataSet['title'];
            $category->slug = Str::slug($dataSet['title']);
            $category->save();
            return redirect()->route('categories')->with('success', 'Category saved successfully');
        }
        return view('admin.category.addEditCat', compact('title', 'category', 'buttonText', 'message'));
    }

    public function catDelete($id)
    {
        try {
            Category::findOrFail($id)->delete();
            //return response()->json(['success' => 'Your category has been deleted!!']);
            return redirect()->back()->with('success','Your category has been deleted!!');
        } catch (\Throwable $th) {
            //dd($th);
            //return response()->json(['error' => 'Your category not deleted!!']);
            return redirect()->back()->with('error','Your category not deleted!!');
        }
    }
}
