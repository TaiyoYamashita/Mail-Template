<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
//use App\Https\Requests\PostController;

class SavedController extends Controller
{
    public function create()
    {
        return view('saved.create');
    }
    
    public function store(Request $request, Post $post) // request編集必要
    {
        $input = $request['post'];
        $input += ['user_id' => $request->user()->id];
        $input += ['private_or_public' => 0];
        $post->fill($input)->save();
        return redirect('/saved/' . $post->id);
    }
    
    public function show(Post $post)
    {
        return view('saved.show')->with(['post' => $post]);
    }
    
    public function save(){
        $path=public_path('save.css');
        $content=File::get($path);
        $type=File::mineType($path);
        return response($content,200)->header('Content-Type',$type);
    }
    
    public function edit(Post $post)
    {
        return view('saved.edit')->with(['post' => $post]);
    }
    
    public function update(Request $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/saved/' . $post->id);
    }
    
    public function post($id)
    {
        $post = Post::findOrFail($id);
        $post->private_or_public = 1;
        $post->posted_at = now();
        $post->save();
        return redirect('/posted/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/saved');
    }
}