<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use App\Http\Requests\StorePostRequest;
use App\Http\Controllers\BaseController;
use App\Http\Requests\UpdatePostRequest;
use App\Repositories\Admin\Post\PostInterface;

class PostController extends Controller
{
    protected $post;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }
    public function getIndex(Request $request)
    {
        $data['posts'] = $this->post->getIndex($request);
        return view('admin.post.index', $data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function addEditPost(Request $request, $id = null)
    {
        if ($id == "") {
            // Add Post
            $post = new Post();
            $title = "Add Post";
            $selTags = array();
            $buttonText = "Save";
            $message = "Post has been saved successfully!";
        } else {
            //Update Post
            $post = Post::find($id);
            $title = "Update Post";
            $buttonText = "Update";
            $message = "Post has been updated successfully!";
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasfile('image')) {
                //echo '<pre>'; print_r($request->hasfile('image')); die;
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    $imageName  = time() . '.' . $image_tmp->getClientOriginalExtension();
                    $post_image_path = 'uploads/post_img/' . $imageName;
                    Image::make($image_tmp)->resize(650, 480)->save($post_image_path);
                    $post->image = $imageName;
                }
            } else {
                $imageName = $post->image;
            }
            //Saving other field to posts table
            $post->category_id = $data['category_id'];
            $post->title = $data['title'];
            $post->tags = $data['tags'];
            $post->slug = Str::slug($post->title);
            $post->description = $data['description'];
            $post->save();
            return redirect()->route('posts')->with('success', $message);
        }
        $categories = Category::select('title', 'id')->get();
        return view('admin.post.addEditPost', compact('title', 'buttonText', 'post', 'message', 'categories'));
    }
    // public function postDelete($id)
    // {
    //     try {
    //         $post = Post::findOrFail($id);
    //         $post_image_path = public_path() . '/uploads/post_img/' . $post['image'];
    //         if (!is_null($post)) {
    //             $post->delete();
    //             unlink($post_image_path);
    //             //return response()->json(['success' => 'Your post has been deleted!!']);
    //             return redirect()->route('posts')->with('success', 'Your post has been deleted!!');
    //         }
    //     } catch (\Throwable $th) {
    //         dd($th);
    //         //return response()->json(['error' => '']);
    //         return redirect()->route('posts')->with('error', 'Your post not deleted!!');
    //     }
    // }
    public function postDelete($id)
    {
        $delRow = $this->post->delete($id);
        return redirect()->back()->with($delRow->redirect_class, $delRow->msg);

    }

    //Image delete
    public function postImageDelete($id)
    {
        try {
            $post = Post::select('image')->where('id', $id)->first();
            echo '<pre>';
            echo '======================<br>';
            print_r($post);
            echo '<br>======================<br>';
            exit();
            $post_image_path = public_path() . '/uploads/post_img/' . $post['image'];

            if (!is_null($post_image_path)) {
                unlink($post_image_path);
                //return response()->json(['success' => 'Your post has been deleted!!']);
                $post = Post::where('id', $id)->update(['image' => '']);
                return redirect()->back()->with('success', 'Your image has been deleted!!');
            }
        } catch (\Throwable $th) {
            //dd($th);
            //return response()->json(['error' => '']);
            return redirect()->back()->with('error', 'Your image not deleted!!');
        }
    }
}
