<?php

namespace App\Http\Services;

use App\Models\Blog;

class CreateBlogService
{
    public function createBlog(array $blog, string $authorId)
    {
        return Blog::create([
            'content' => $blog['content'],
            'author_id' => $authorId,
        ]);
    }
}
