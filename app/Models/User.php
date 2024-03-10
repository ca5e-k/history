<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Like;
use App\Models\Post;
use App\Models\Life;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(){
        return $this->HasMany(Post::class);
    }
    
    public function likes(){
      return $this->HasMany(Like::class);
    }

    public function lifes(){
      return $this->HasMany(Life::class);
    }

    public function following() {
        return $this->belongsToMany(User::class, 'relationships', 'follower_id', 'followed_id');
    }
    
    public function followers() {
        return $this->belongsToMany(User::class, 'relationships', 'followed_id', 'follower_id');
    }

    // 相互フォローユーザーを取得
    public function mutualFollows()
    {
    // ユーザーがフォローしている人たち
    $following = $this->following()->pluck('followed_id')->toArray();

    // ユーザーをフォローしている人たち
    $followers = $this->followers()->pluck('follower_id')->toArray();

    // 相互フォローしているユーザーIDのみを抽出
    $mutualFollowsIds = array_intersect($following, $followers);

    // 相互フォローしているユーザーのコレクションを返す
    return User::whereIn('id', $mutualFollowsIds)->get();
    }
}
