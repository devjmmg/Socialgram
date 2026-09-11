<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
    use HasFactory;

    // protected $primaryKey = 'id';
    // protected $table = 'like_comments';
    protected $fillable = [
        'user_id',
        'comment_id',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function comment()
    {
        $this->belongsTo(Comment::class);
    }
    
}
