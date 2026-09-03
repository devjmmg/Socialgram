<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index(User $user)
    {
        $posts = $user->posts()->latest()->paginate(20);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
            'total' => $user->posts()->count(),
            'followers' => $user->followers()->wherePivot('status', 'accepted')->count(),
            'following' => $user->following()->wherePivot('status', 'accepted')->count(),

        ]);
        
    }
    
    public function create() {
        
        return view('posts.create');
        
    }
    
    public function store(Request $request) {
        
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
        ], [
            'title.required' => 'El título es requerido.',
            'description.required' => 'La descripción es requerida.',
            'image.required' => 'Debes seleccionar una imagen.',
        ]);
        
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image
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
