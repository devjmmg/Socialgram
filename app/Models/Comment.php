<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $id = 'id';

    protected $fillable = [
        'id', 'comment', 'user_id', 'post_id', 'parent_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(LikeComment::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function checkLike(User $user){
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
