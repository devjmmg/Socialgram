<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    public function store(User $user, Post $post, Request $request)
    {
        //Se debe pasar el usuario por el route model binding
        
        //Validar el comentario
        $this->validate($request, [
            'comment' => 'required|max:255'
        ]);
        
        //Crear el comentario
        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id
        ]);
        
        //Imprimir mensaje y regresar a la publicación
        return back()->with('mensaje','Comentario publicado');
        
    }
    
}
