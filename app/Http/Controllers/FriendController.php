<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index($username)
    {
        // Buscar amigos que coincidan con el valor de 'username'
        $friends = User::where('username', 'LIKE', $username . '%')->get();
        return response()->json($friends);
    }
}
