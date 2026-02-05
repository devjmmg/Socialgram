<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];
    
    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    //One to Many
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    //Many to Many
    //Almacena los seguidores de un usuario (quiénes me siguen)
    //Nota: El metodo followers en la tabla de followers pertenece a muchos usuarios
    public function followers()
    {
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    //Almacena los que nosotros seguimos (quiénes sigo)
    public function following()
    {
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    //¿Ya lo seguimos?
    //En la url tiene el usuario a quien estamos siguiendo y es quien
    //preguntamos si es seguido por nosotros el que esta autenticado
    public function followedBy(User $user)
    {
        //return $this->followers->contains($user->id);
        
        $follow = $this->followers()->where('follower_id', $user->id)->first();

        if (!$follow) {
            return false;
        }

        return true;
    }

    
}
