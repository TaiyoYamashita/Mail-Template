<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostedController extends Controller
{
    public function show(Post $post)
    {
        return view('posted.show')->with(['post' => $post]);
    }
    
    public function save($id)
    {
        $post = Post::findOrFail($id);
        $post->private_or_public = 0;
        $post->save();
        return redirect('/saved/' . $post->id);
    }
}
