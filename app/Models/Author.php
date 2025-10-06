<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Author extends Authenticatable
{
    protected $table = 'authors';

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password'];
    
	public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }

    public function reactions()
    {
        return $this->hasMany(Reaction::class, 'user_id');
    }
}
