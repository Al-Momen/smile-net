<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;


class TagController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['tags'] = Tag::orderBy('id', 'DESC')->get();
        return view('admin.tag.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tag $tag)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo '<pre>';
            // echo '======================<br>';
            // print_r($dataSet);
            // echo '<br>======================<br>';
            // exit();
            $tag->tag_title = $data['tag_title'];
            $tag->tag_slug = Str::slug($data['tag_title']);
            $tag->save();
            return redirect()->back()->with('success', 'Tag saved successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Tag::find($id)->update([
            'tag_title' => $request->tag_title,
            'tag_slug' => Str::slug($request->tag_slug)
        ]);
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::find($id)->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
