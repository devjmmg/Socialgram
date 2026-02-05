<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    
    public function update(Request $request)
    {

        $this->validate($request,[
            'password_current' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if(!Hash::check($request->password_current,auth()->user()->password))
        {
            return back()->with('password','La contraseña actual es incorrecta');
        }

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success','La contraseña se cambio correctamente');

    }

}
