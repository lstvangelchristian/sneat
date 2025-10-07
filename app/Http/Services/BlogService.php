<?php

namespace App\Http\Services;

use App\Models\Blog;

class BlogService
{
    public function createBlog(array $blog, string $authorId)
    {
        return Blog::create([
            'content' => $blog['content'],
            'author_id' => $authorId,
        ]);
    }

    public function getBlogs()
    {
        return Blog::with('reactions', 'comments')->latest()->get();
    }

    public function getBlog(string $blogId)
    {
        return Blog::findOrFail($blogId);
    }

    public function updateBlog(array $data, string $id)
    {
        $blog = Blog::findOrFail($id);

        return $blog->update($data);
    }

    public function deleteBlog(string $id)
    {
        $blog = Blog::findOrFail($id);

        return $blog->delete($blog);
    }
}
