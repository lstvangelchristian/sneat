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

    public function getReply(string $replyId)
    {
        $reply = Reply::findOrFail($replyId);

        return response()->json([
            'view' => view('components.reply.update-reply', ['reply' => $reply])->render(),
            'replyId' => $replyId,
        ]);
    }

    public function updateReply(Request $request)
    {
        $validated = $request->validate([
            'replyId' => 'required|integer',
            'updatedReply' => 'required',
        ]);

        $replyToBeUpdated = Reply::findOrFail($validated['replyId']);

        $newReply = ['content' => $validated['updatedReply']];

        $replyToBeUpdated->update($newReply);

        return response()->json(['success' => true]);
    }

    public function deleteReply(string $id)
    {
        $reply = Reply::findOrFail($id);

        $reply->delete();

        return response()->json(['success' => true]);
    }
}
