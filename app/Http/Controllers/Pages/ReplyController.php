<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function getReplies(string $commentId)
    {
        $replies = Reply::with('authors')->where('comment_id', $commentId)->latest()->get();

        return response()->json([
            'view' => view('components.reply.get-replies', ['replies' => $replies, 'commentId' => $commentId])->render(),
            'commentId' => $commentId,
        ]);
    }

    public function createReply(Request $request)
    {
        $id = auth('author')->id();

        $validated = $request->validate([
            'commentId' => 'required|integer',
            'content' => 'required',
        ]);

        $newReply = [
            'comment_id' => $validated['commentId'],
            'user_id' => $id,
            'content' => $validated['content'],
        ];

        $result = Reply::create($newReply);

        return response()->json([
            'success' => true,
            'newReply' => $result,
        ]);
    }
}
