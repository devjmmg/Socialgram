<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class PostController extends Controller
{

    public function index(User $user)
    {
        return view('dashboard',[
            'user' => $user
        ]);
    }
    
    public function create() {
        
        return view('posts.create');
        
    }
    
    public function store(Request $request) {
        
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ], [
            'title.required' => 'El título es requerido.',
            'description.required' => 'La descripción es requerida.',
            'image.required' => 'Debes seleccionar una imagen.',
            'image.image' => 'El archivo debe ser una imagen.',
        ]);

        $image = $request->file('image');
        $imageName = Str::uuid() . '.webp';
        $serverImage = Image::read($image);
        Storage::disk('public')->put(
            'uploads/' . $imageName,
            $serverImage->toWebp(90)
        );
        
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName
        ]);
        
        return redirect()->route('posts.index', auth()->user()->username);
        
    }
    
    public function show(User $user,Post $post)
    {
        return view('posts.show',[
            'user' => $user,
            'post' => $post
        ]);
    }
    
    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        Storage::disk('public')->delete(
            'uploads/' . $post->image
        );
        $post->delete();   
        return redirect()->route('posts.index',auth()->user()->username);
    }
    
}
