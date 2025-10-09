<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequests\CreateReplyRequest;
use App\Http\Requests\ReplyRequests\UpdateReplyRequest;
use App\Http\Services\ReplyService;

class ReplyController extends Controller
{
    protected $replyService;

    protected $authId;

    public function __construct(ReplyService $service)
    {
        $this->replyService = $service;
        $this->authId = $id = auth('author')->id();
    }

    public function getReplies(string $commentId)
    {
        try {
            $replies = $this->replyService->getReplies($commentId);

            return response()->json([
                'view' => view('components.reply.get-replies', ['replies' => $replies, 'commentId' => $commentId])->render(),
                'commentId' => $commentId,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function createReply(CreateReplyRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->replyService->createReply($validated, $this->authId);

            return response()->json(
                [
                    'success' => true,
                ]
            );
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function getReply(string $id)
    {
        try {
            $reply = $this->replyService->getReply($id);

            return response()->json([
                'view' => view('components.reply.update-reply', ['reply' => $reply])->render(),
                'replyId' => $id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function updateReply(UpdateReplyRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->replyService->updateReply($validated);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function deleteReply(string $id)
    {
        try {
            $this->replyService->deleteReply($id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }
}
