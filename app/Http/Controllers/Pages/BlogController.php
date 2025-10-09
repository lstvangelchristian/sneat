<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequests\CreateBlogRequest;
use App\Http\Requests\BlogRequests\UpdateBlogRequest;
use App\Http\Services\BlogService;

class BlogController extends Controller
{
    protected $blogService;

    protected $authId;

    public function __construct(BlogService $service)
    {
        $this->authId = auth('author')->id();

        $this->blogService = $service;
    }

    public function showBlogs()
    {
        try {
            $blogs = $this->blogService->getBlogs();

            if (request()->ajax()) {
                return view('components.blog.load-blogs', ['blogs' => $blogs]);
            }

            return view('pages.blog', ['blogs' => $blogs]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }

    public function createBlog(CreateBlogRequest $request)
    {
        try {
            $validated = $request->validated();

            $this->blogService->createBlog($validated, $this->authId);

            return response()->json([
                'success' => true,
                'message' => 'Your blog has been posted successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }

    public function renderUpdateModal(string $id)
    {
        try {
            $blog = $this->blogService->getBlogById($id);

            return view('components.blog.update-blog', ['blog' => $blog]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }

    public function updateBlog(UpdateBlogRequest $request, string $id)
    {
        try {
            $validated = $request->validated();

            $this->blogService->updateBlog($validated, $id);

            return response()->json([
                'success' => true,
                'message' => 'Your blog has been updated successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }

    public function deleteBlog(string $id)
    {
        try {
            $result = $this->blogService->deleteBlog($id);

            return response()->json([
                'success' => true,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors' => [
                    'exception' => ['Sorry, something went wrong. Please try again later.']],
            ]);
        }
    }
}
