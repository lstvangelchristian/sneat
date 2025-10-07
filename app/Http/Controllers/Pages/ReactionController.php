<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function createReaction(Request $request)
    {
        try {
            $id = auth('author')->id();

            $validated = $request->validate([
                'blog_id' => 'required|integer',
                'type_id' => 'required|integer',
            ]);

            $newReaction = Reaction::updateOrCreate(
                [
                    'blog_id' => $validated['blog_id'],
                    'user_id' => $id,
                ],
                [
                    'type_id' => $validated['type_id'],
                ]
            );

            return response()->json($newReaction);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.'],
                    'message' => [$e]],
            ]);
        }
    }

    public function getReactionsByBlogId(string $id)
    {
        $reactions = Reaction::where('blog_id', $id)->with('user')->latest()->get();

        return view('components.reaction.get-reactions', ['reactions' => $reactions]);
    }
}
