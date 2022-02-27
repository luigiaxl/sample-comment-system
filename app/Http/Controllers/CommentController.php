<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Fetch a list of comments
     */
    public function index()
    {
        $comments = Comment::orderByDesc('updated_at')->get();

        return response()->json($comments);
    }

    /**
     * Create new comment
     * 
     * @param StoreCommentRequest $request 
     * @return Comment JSON
     */
    public function store(StoreCommentRequest $request)
    {
        $data = $request->validated();

        $comment = Comment::create($data);

        return response()->json($comment);
    }

    /**
     * Create a new comment as a reply for another comment
     * 
     * @param StoreCommentRequest $request
     * @param Comment $comment id of comment to reply on
     * @return Comment JSON
     */
    public function reply(StoreCommentRequest $request, Comment $comment)
    {
        $data = $request->validated();
        
        $reply = $comment->replies()->create($data);

        return response()->json($reply);
    }
}
