<?php

namespace App\Http\Services;

use App\Models\Blog;

class BlogService
{
    public function getBlogs()
    {
        return Blog::with('reactions', 'comments')->latest()->get();
    }

    public function createBlog(array $validated, string $authId)
    {
        $newBlog = [
            'content' => $validated['content'],
            'author_id' => $authId,
        ];

        return Blog::create($newBlog);
    }

    public function getBlogById(string $blogId)
    {
        return Blog::findOrFail($blogId);
    }

    public function updateBlog(array $validated, string $id)
    {
        $blog = Blog::findOrFail($id);

        $updatedBlog = ['content' => $validated['updatedContent']];

        return $blog->update($updatedBlog);
    }

    public function deleteBlog(string $blogId)
    {
        $blog = Blog::findOrFail($blogId);

        return $blog->delete($blog);
    }
}
