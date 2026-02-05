<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Auth\Access\AuthorizationException;

class ProfileController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit(User $user)
    {
        
        try {
            
            $this->authorize('update',$user);
            
            return view('profile.edit',[
                'user' => $user
            ]);
            
        } catch (AuthorizationException  $th) {
            
            return redirect()->route('posts.index',$user);
            
        }
        
    }
    
    public function update(Request $request)
    {
        
        $request->request->add(['username' => Str::slug($request->username)]);
        
        $this->validate($request,[
            'name' => 'required|max:30|string',
            'username' => 'required|unique:users,username,'.auth()->user()->id.'|min:5|max:30',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id.'|max:100',
        ]);

        if($request->file('image'))
        {
            //Obtener el archivo subido
            $image = $request->file('image');
            
            //Generar un nombre único para la imagen
            // $imageName = Str::uuid() . '.' .  $image->extension();
            $imageName = Str::uuid() . '.avif';
            
            $serverImage = Image::read($image); // Crear una instacia de Intervention Image
            $serverImage->cover(1000,1000); // Redimensionar la imagen
            
            //Ruta donde se va a guardar la imagen
            $pathImage = public_path('profiles/'.$imageName);
            
            // Asegurarse de que el directorio exista
            if (!file_exists(public_path('profiles'))) {
                mkdir(public_path('profiles'), 0755, true);
            }
            
            //Guardar la imagen modificada
            $serverImage->toAvif()->save($pathImage);

            //Quitar la antigua imagen
            if($request->user()->image){
                unlink(public_path('profiles/'.$request->user()->image));
            }
        }

        $user = User::find(auth()->user()->id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->image = $imageName ?? auth()->user()->image ?? '';
        $user->save();

        return redirect()->route('posts.index',$user);
        
    }
    
}
