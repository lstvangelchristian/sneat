<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReactionRequests\CreateReactionRequest;
use App\Http\Services\ReactionService;

class ReactionController extends Controller
{
    protected $reactionService;

    protected $authId;

    public function __construct(ReactionService $service)
    {
        $this->reactionService = $service;
        $this->authId = auth('author')->id();
    }

    public function createReaction(CreateReactionRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->reactionService->createReaction($validated, $this->authId);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }

    public function getReactionsByBlogId(string $id)
    {
        try {
            $reactions = $this->reactionService->getReactionsByBlodId($id);

            return view('components.reaction.get-reactions', ['reactions' => $reactions]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                ],
            ]);
        }
    }
}
