<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ],[
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El formato del correo electrónico es incorrecto.',
            'password.required' => 'La contraseña es requerida.'
        ]);

        if(!auth()->attempt($request->only('email','password'),$request->remember)) {
            return back()->with('mensaje','El correo electrónico o la contraseña son incorrectas');
        }

        return redirect()->route('home.index');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'name' => 'required|max:30|string',
            'username' => 'required|unique:users|min:5|max:30',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|confirmed|min:8',
        ], [
            'name.required' => 'El nombre es requerido.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            'name.string' => 'El nombre debe ser un texto válido.',
            'username.required' => 'El nombre de usuario es requerido.',
            'username.unique' => 'El nombre de usuario se encuentra en uso.',
            'username.min' => 'El nombre de usuario debe tener al menos 5 caracteres.',
            'username.max' => 'El nombre de usuario no puede tener más de 30 caracteres.',

            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico debe tener un formato válido.',
            'email.unique' => 'El correo electrónico se encuentra en uso.',
            'email.max' => 'El correo electrónico no puede tener más de 100 caracteres.',

            'password.required' => 'La contraseña es requerida.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ]);


        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }

}
