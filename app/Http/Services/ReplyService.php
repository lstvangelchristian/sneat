<?php

namespace App\Http\Services;

use App\Models\Reply;

class ReplyService
{
    public function getReplies($commentId)
    {
        return Reply::with('authors')->where('comment_id', $commentId)->latest()->get();
    }

    public function createReply(array $validated, string $authId)
    {
        $newReply = [
            'comment_id' => $validated['commentId'],
            'user_id' => $authId,
            'content' => $validated['content'],
        ];

        return Reply::create($newReply);
    }

    public function getReply(string $replyId)
    {
        return Reply::findOrFail($replyId);
    }

    public function updateReply(array $validated)
    {
        $replyToBeUpdated = Reply::findOrFail($validated['replyId']);

        return $replyToBeUpdated->update(['content' => $validated['updatedReply']]);
    }

    public function deleteReply(string $replyId)
    {
        $reply = Reply::findOrFail($replyId);

        return $reply->delete();
    }
}
