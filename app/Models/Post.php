<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'body', 
        'user_id',
        'status',
    ]; 

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    // statusフィールドを操作可能にする

    // 下書きの投稿を取得するスコープ
    // public function scopeDraft($query)
    // {
    //     return $query->where('status', 'draft');
    // }

    // // 公開された投稿を取得するスコープ
    // public function scopePublished($query)
    // {
    //     return $query->where('status', 'published');
    // }
}
