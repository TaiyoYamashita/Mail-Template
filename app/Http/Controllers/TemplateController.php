<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post; //モデルも使用宣言をする
use App\Models\Favorite;

class TemplateController extends Controller
{
    public function top(){
        return view('auth.login');
    }
    
    public function register(){
        return view('auth.register');
    }
    
    public function everybody(Post $post){
        return view('everybody.everyone')->with(['all_posts' => $post->getPublicPaginateByLimit()]);
    }
    
    public function genre(){
        return view('genre.genres');
    }
    
    public function history(){
        return view('history.histories');
    }
    
    public function saved(User $user){
        return view('saved.saves')->with(['own_posts' => $user->getSavedPaginateByLimit()]);
    }
    
    public function favorite(Favorite $favorite)
    {
        $kari = $favorite->getFavoritePaginateByLimit();
        //dd($kari);
        return view('favorite.favorites')->with(['favorites' => $favorite->getFavoritePaginateByLimit()]);
    }
    
    public function posted(User $user){
        return view('posted.posts')->with(['own_posts' => $user->getPostedPaginateByLimit()]);
    }
    
    public function paper(){
        $path=public_path('paper.css');
        $content=File::get($path);
        $type=File::mineType($path);
        return response($content,200)->header('Content-Type',$type);
    }
}
