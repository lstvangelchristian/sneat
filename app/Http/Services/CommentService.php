<?php

namespace App\Http\Services;

use App\Models\Comment;

class CommentService
{
    public function createComment(array $validated, string $authId)
    {
        return Comment::create(
            [
                'content' => $validated['content'],
                'blog_id' => $validated['blogId'],
                'user_id' => $authId,
            ]
        );
    }

    public function getComments(string $blogId)
    {
        return Comment::with('user', 'replies')->where('blog_id', $blogId)->latest()->get();
    }

    public function getComment(string $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        return $comment;
    }

    public function updateComment(array $validated)
    {
        $commentToBeUpdated = Comment::findOrFail($validated['commentId']);

        return $commentToBeUpdated->update(['content' => $validated['updatedComment']]);
    }

    public function deleteComment(string $commentId)
    {
        $commentToBeDeleted = Comment::findOrFail($commentId);

        return $commentToBeDeleted->delete();
    }
}
