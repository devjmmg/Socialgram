<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{

    public function __invoke()
    {
        $posts = Post::whereIn('user_id', auth()->user()->following()->wherePivot('status', 'accepted')->select('users.id'))->latest()->paginate(20);

        return view('home',[
            'posts' => $posts    
        ]);
    }
}
