<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $id = 'id';

    protected $fillable = [
        'id', 'comment', 'user_id', 'post_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
