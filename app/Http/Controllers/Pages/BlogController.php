<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Services\BlogService;

class BlogController extends Controller
{
    protected $blogService;

    public function __construct(BlogService $service)
    {
        $this->blogService = $service;
    }

    public function showBlog()
    {
        $blogs = $this->blogService->getBlogs();

        return view('pages.blog', ['blogs' => $blogs]);
    }

    public function createBlog(BlogRequest $request, BlogService $service)
    {
        try {
            $validated = $request->validated();

            $id = auth('author')->id();

            $this->blogService->createBlog($validated, $id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }
}
