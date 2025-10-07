<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;

class CommentController extends Controller
{
    public function createComment(CommentRequest $request)
    {
        try {
            $id = auth('author')->id();

            $validated = $request->validated();

            $newComment = [
                'content' => $validated['content'],
                'blog_id' => $validated['blogId'],
                'user_id' => $id,
            ];

            $result = Comment::create($newComment);

            return response()->json(['result' => $result]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function renderCreateCommentModal(string $id)
    {
        return view('components.comment.create-comment', ['blogId' => $id]);
    }

    public function renderComments(string $id)
    {
        $comments = Comment::with('user')->where('blog_id', $id)->latest()->get();

        return view('components.comment.get-comments', ['comments' => $comments]);
    }
}
