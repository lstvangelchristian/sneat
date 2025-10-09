<?php

namespace App\Http\Services;

use App\Models\Reaction;

class ReactionService
{
    public function createReaction(array $validated, string $authId)
    {
        return Reaction::updateOrCreate(
            [
                'blog_id' => $validated['blog_id'],
                'user_id' => $authId,
            ],
            [
                'type_id' => $validated['type_id'],
            ]);
    }

    public function getReactionsByBlodId(string $blogId)
    {
        return Reaction::where('blog_id', $blogId)->with('user')->latest()->get();
    }
}
