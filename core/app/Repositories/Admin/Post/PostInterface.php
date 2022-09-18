<?php

namespace App\Repositories\Admin\Post;


interface PostInterface
{
    public function getIndex($request);
    public function delete(int $id);
}
