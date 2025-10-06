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
}
