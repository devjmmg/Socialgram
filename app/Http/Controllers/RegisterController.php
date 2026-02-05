<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function index()
    {

        return view('auth.register');

    }

    public function store(Request $request)
    {

        // dd("Store...");
        // dd($request->get('name'));

        //Modificar el Request (No se recomienda hacerlo)
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validación
        $this->validate($request, [
            'name' => 'required|max:30|string',
            'username' => 'required|unique:users|min:5|max:30',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|confirmed|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //Atenticar un usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        //Redireccionar
        //return redirect()->route('posts.index');
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);

    }

}
