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

        if (request()->ajax()) {
            return view('components.blog.get-blogs', ['blogs' => $blogs]);
        }

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

    public function renderUpdateModal(string $id)
    {
        $blog = $this->blogService->getBlog($id);

        return view('components.blog.update-blog', ['blog' => $blog]);
    }

    public function updateBlog(BlogRequest $request, string $id)
    {
        try {
            $validated = $request->validated();

            $new = ['content' => $validated['updatedContent']];

            $result = $this->blogService->updateBlog($new, $id);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }

    public function deleteBlog(string $id)
    {
        $result = $this->blogService->deleteBlog($id);

        return response()->json(['success' => true]);
    }
}
