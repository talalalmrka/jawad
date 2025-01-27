<?php

namespace App\Http\Controllers\Dashboard\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate();
        return view('dashboard.posts.index', [
            'posts' => $posts,
        ]);
    }
    public function create()
    {
        return view('dashboard.posts.edit', [
            'post' => new Post(),
        ]);
    }
    public function store(Request $request)
    {
        if (empty($request->slug)) {
            $request->merge([
                'slug' => Post::generateSlug($request->name),
            ]);
        }
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')],
            'description' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:2024'],
        ]);
        $post = Post::create($validated);
        if ($post) {
            return redirect(route('dashboard.posts.edit', $post))->with('status', __('Post created'));
        } else {
            return back()->withErrors([
                'status' => __('Create post failed!'),
            ]);
        }
    }
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'post' => $post,
        ]);
    }
    public function update(Request $request, Post $post)
    {
        if (empty($request->slug)) {
            $request->merge([
                'slug' => Post::generateSlug($request->name),
            ]);
        }
        $validated = $request->validate([
            'user_id' => ['required', Rule::exists('users', 'id')],
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('posts', 'slug')->ignore($post->id)],
            'description' => ['nullable', 'string', 'max:255'],
            'content' => ['nullable', 'string', 'max:2024'],
        ]);
        $save = $post->update($validated);
        if ($save) {
            return back()->with('status', __('Post saved.'));
        } else {
            return back()->withErrors([
                'status' => __('Save post failed!'),
            ]);
        }
    }
    public function delete(Post $post)
    {
        $delete = $post->delete();
        if ($delete) {
            return back()->with('status', __('Post deleted'));
        } else {
            return back()->withErrors([
                'status' => __('Delete post failed'),
            ]);
        }
    }
}
