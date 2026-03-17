<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request)
    {
        Comment::create([
            'article_id' => $request->article_id,
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('articles.show', $request->article_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('articles.show', $comment->article_id);
    }
}
