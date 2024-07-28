<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'post_id',
        'used_at'
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
    public function getHistoryPaginateByLimit(int $limit = 20)
    {
        //return $this::with('posts')->find(Auth::id())->post()->orderBy('updated_at', 'DESC')->paginate($limit);
        return $this::with('post')->where('user_id', Auth::id())->orderBy('updated_at', 'DESC')->paginate($limit);
    }
}
