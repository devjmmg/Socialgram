<?php

namespace App\Http\Controllers;

use App\Models\Post;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //public function index()
    // {
    //     return view('principal');
    // }

    //Solo si vamos a tener un metodo
    //manda a llamar esta función nadamas
    //y no deja elegir otro método
    public function __invoke()
    {

        //Obtener a quiénes seguimos (id)
        //dd(auth()->user()->following->pluck('id'));
        //dd(auth()->user()->following->pluck('id')->toArray());

        $ids = auth()->user()->following->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        //dd($posts);

        return view('home',[
            'posts' => $posts    
        ]);
    }
}
