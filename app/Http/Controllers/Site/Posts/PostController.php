<?php

namespace App\Http\Controllers\Site\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();
        return view('site.posts.index', [
            'posts' => $posts,
        ]);
    }
    public function single(Post $post)
    {
        return view('site.posts.single', [
            'post' => $post,
        ]);
    }
}
