<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Fetch a list of base comments
     */
    public function index()
    {
        $comments = Comment::whereNull('comment_id')->orderByDesc('created_at')->get();

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
     * Get a list of replies for the comment
     * 
     * @param Comment $comment
     * return Comments array
     */
    public function replies (Comment $comment)
    {
        $replies = $comment->replies()->orderByDesc('created_at')->get();

        return response()->json($replies);
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
        $data['level'] = $comment->level + 1;
        
        $reply = $comment->replies()->create($data);

        return response()->json($reply);
    }
}
