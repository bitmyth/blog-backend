<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin')
            ->except(['index', 'show']);
    }

    public function search()
    {
        return Post::with(['tags', 'category', 'user'])
            ->join('term_object', 'posts.id', '=', 'term_object.object_id')
            ->join('terms', function ($join) {
                $join->on('term_object.term_id', '=', 'terms.id')
                    ->where('terms.taxonomy', 'category');
            });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($categoryId = request('category')) {
            $posts = $this->search()
                ->where('term_id', $categoryId);
        } else {
            $posts = Post::with(['tags', 'category', 'user']);
        }
        $posts = $posts->orderByDesc('posts.created_at')
            ->paginate(10);

        foreach ($posts as $post) {
            $post->url = env('APP_URL').route('posts.show', ['post' => $post->id], false);
        }

        return $posts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post($request->only('title', 'excerpt', 'name', 'content'));

        if (!$post->name) {
            $post->name = str_slug($post->title);
        }
        auth()->user()->posts()->save($post);

        return $this->created($post);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return $post->load(['user', 'tags', 'category']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PostRequest $request
     * @param Post        $post
     *
     * @return Post|\App\Post
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $post->update($request->only('title', 'excerpt', 'name', 'content'));

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Post $post
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return $post;
    }
}
