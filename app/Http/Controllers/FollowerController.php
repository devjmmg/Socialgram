<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{

    public function index()
    {
        return view('followers.index');
    }
    
    public function store(User $user, Request $request)
    {
        //Primera forma de insertar
        // Follower::create([
        //     'user_id' => $user->id,
        //     'follower_id' => auth()->user()->id,
        // ]);

        //Segunda forma de insertar con una función en el modelo User
        // $user->followers()->attach([
        //     'follower_id' => auth()->user()->id,
        // ]);

        //Tercer forma
        $user->followers()->attach( auth()->user()->id );
        return back();
    }

    public function destroy(User $user, Request $request)
    {
        $user->followers()->detach( auth()->user()->id );
        return back();
    }

}
