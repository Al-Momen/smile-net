<?php

namespace App\Repositories\Admin\Post;
use App\Models\Post;
use App\Traits\RepoResponse;
use Illuminate\Support\Facades\DB;
class PostAbstract implements PostInterface
{
    use RepoResponse;
    public function getIndex($request)
    {
        $posts = DB::table('posts')->get();
        return $posts;
    }
    // Delete Post using postabstract and postinterface
    public function delete(int $id)
    {
        DB::begintransaction();
        try {
            $post = Post::findOrFail($id);
            $post_image_path = public_path() . '/uploads/post_img/' . $post['image'];
            if (!is_null($post)) {
                $post->delete();
                unlink($post_image_path);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return $this->formatResponse(false, 'Unable to delete post!', 'posts');
        }
        DB::commit();
        return $this->formatResponse(true, 'Successfully delete post!', 'posts');
    }
}
