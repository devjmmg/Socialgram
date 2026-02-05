<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }
    
    public function index(User $user)
    {
        
        $posts = $user->posts()->latest()->paginate(20);
        return view('dashboard',[
            'user' => $user,
            'posts' => $posts,
            'total' => $user->posts()->count(),
            'followers' => $user->followers()->count(),
            'following' => $user->following()->count(),

        ]);
        
    }
    
    public function create() {
        
        return view('posts.create');
        
    }
    
    public function store(Request $request) {
        
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required',
            'image' => 'required',
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
        $post->delete();
        
        $pathImage = public_path('uploads/'.$post->image);

        if(File::exists($pathImage)) {
            unlink($pathImage);
            //File::delete($pathImage);
        }
        
        return redirect()->route('posts.index',auth()->user()->username);
        
    }
    
}
