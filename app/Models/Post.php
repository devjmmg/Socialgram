<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'title', 'description', 'image', 'user_id'
    ];

    //Belongs To (Pertenece a)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Has Many (Tiene muchos)
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //Has Many (Tiene muchos)
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Método 
    public function checkLike(User $user){

        return $this->likes->contains('user_id',$user->id);

    }

}
