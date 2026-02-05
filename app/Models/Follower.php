<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'user_id', 'follower_id', 'accepted'
    ];

}
