<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Services\CreateBlogService;

class BlogController extends Controller
{
    public function showBlog()
    {
        return view('pages.blog');
    }

    public function createBlog(BlogRequest $request, CreateBlogService $service)
    {
        try {
            $validated = $request->validated();

            $id = auth('author')->id();

            $service->createBlog($validated, $id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }
}
