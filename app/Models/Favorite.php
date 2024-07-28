<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class Favorite extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'saved_at'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
    
    //Userモデルで呼び出す？
    public function getFavoritePaginateByLimit(int $limit = 20)
    {
        //return $this::with('posts')->find(Auth::id())->post()->orderBy('updated_at', 'DESC')->paginate($limit);
        return $this::with(['user','post'])->where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->paginate($limit);
    }
}
