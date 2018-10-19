<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
//        $this->middleware('can:delete,comment')->only('destroy');
//        $this->middleware('can:update,comment')->only('update');
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $post
     * @return void
     */
    public function index($post = null)
    {
        if ($post = Post::find($post)) {
            $comments = $post->comments();
        } else {
            $comments = Comment::query();
        }

        return $comments->latest()
            ->with('user')
            ->paginate();

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CommentRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request, $post)
    {
        $postId = $post ?? $request->get('post_id');

        $post = Post::find($postId);
        $comment = new Comment($request->all());
        $comment->post_id = $postId;

        DB::transaction(function () use ($post, $comment, $request) {
            auth()->user()->comments()->save($comment);
            $post->increment('comment_count');
        });

        return $this->created($comment);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return $comment;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'content' => 'required'
        ]);
        $comment->update($request->only('content'));
        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment $comment
     * @throws \Exception
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        DB::transaction(function () use ($comment) {
            $comment->post->decrement('comment_count');
            $comment->delete();
        });
    }
}
