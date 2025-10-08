<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

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
        $comments = Comment::with('user', 'replies')->where('blog_id', $id)->latest()->get();

        return view('components.comment.get-comments', ['comments' => $comments]);
    }

    public function getComment(string $commentId)
    {
        $comment = Comment::findOrFail($commentId);

        return response()->json([
            'content' => (string) view('components.comment.update-comment', ['comment' => $comment]),
            'commentId' => $commentId,
        ]);
    }

    public function loadComments(string $blogId)
    {
        $comments = Comment::with('user', 'replies')->where('blog_id', $blogId)->latest()->get();

        return view('components.comment.load-comments', ['comments' => $comments]);
    }

    public function updateComment(Request $request)
    {
        $validated = $request->validate([
            'commentId' => 'required',
            'updatedComment' => 'required',
        ]);

        $commentToBeUpdated = Comment::findOrFail($validated['commentId']);

        $newComment = ['content' => $validated['updatedComment']];

        $result = $commentToBeUpdated->update($newComment);

        return response()->json(['success' => true]);
    }

    public function deleteComment(string $id)
    {
        $commentToBeDeleted = Comment::findOrFail($id);

        $res = $commentToBeDeleted->delete();

        return response()->json([
            'success' => true,
        ]);
    }
}
