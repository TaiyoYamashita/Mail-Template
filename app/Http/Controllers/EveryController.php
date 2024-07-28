<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Favorite;

class EveryController extends Controller
{
    public function show(Post $post)
    {
        return view('everybody.show')->with(['post' => $post]);
    }
    
    public function create($id)
    {
        $post = Post::findOrFail($id);
        return view('everybody.create')->with(['post' => $post]);
    }
    
    public function register(Request $request, Post $post, Favorite $favorite)
    {
        $input = ['user_id' => $request->user()->id];
        $input += ['post_id' => $post->id];
        $input += ['saved_at' => now()];
        $favorite->fill($input)->save();
        return redirect('/every/' . $post->id);
    }
}
