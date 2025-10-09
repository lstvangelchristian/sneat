<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequests\CreateCommentRequest;
use App\Http\Requests\CommentRequests\UpdateCommentRequest;
use App\Http\Services\CommentService;

class CommentController extends Controller
{
    protected $commentService;

    protected $authId;

    public function __construct(CommentService $service)
    {
        $this->authId = auth('author')->id();

        $this->commentService = $service;
    }

    public function createComment(CreateCommentRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->commentService->createComment($validated, $this->authId);

            return response()->json([
                'success' => true,
                'message' => 'Your comment has been posted successfully',
            ]);
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
        try {
            $comments = $this->commentService->getComments($id);

            return view('components.comment.get-comments', ['comments' => $comments]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function getComment(string $id)
    {
        try {
            $comment = $this->commentService->getComment($id);

            return response()->json([
                'content' => view('components.comment.update-comment', ['comment' => $comment])->render(),
                'commentId' => $id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function loadComments(string $id)
    {
        try {
            $comments = $this->commentService->getComments($id);

            return view('components.comment.load-comments', ['comments' => $comments]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function updateComment(UpdateCommentRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->commentService->updateComment($validated);

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function deleteComment(string $id)
    {
        try {
            $this->commentService->deleteComment($id);

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }
}
