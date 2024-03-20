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
use App\Models\MessageRoom;

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

    // ★相互フォロー機能★
    // 1.フォローの定義
    public function following() {
        return $this->belongsToMany(User::class, 'relationships', 'follower_id', 'followed_id');
    }
    // 2.フォロワーの定義
    public function followers() {
        return $this->belongsToMany(User::class, 'relationships', 'followed_id', 'follower_id');
    }

    // 相互フォローユーザーの定義
    public function mutualFollows()
    {
    // ユーザーがフォローしている人たち
    $following = $this->following()->pluck('followed_id')->toArray();//pluckは指定したキーをすべて取得すること

    // ユーザーをフォローしている人たち
    $followers = $this->followers()->pluck('follower_id')->toArray();//toArrayはすべてのリレーションを配列にするため

    // 相互フォローしているユーザーIDのみを抽出
    $mutualFollowsIds = array_intersect($following, $followers);//他の全ての引数に存在する array の値を全て有する配列を返します。 キーと値の関係は維持される

    // 相互フォローしているユーザーのコレクションを返す
    return User::whereIn('id', $mutualFollowsIds)->get();
    }

    // 多対多の内容を記述するモデルに詳細内容を記載
    public function messageRooms()
   {
    return $this->belongsToMany(MessageRoom::class, 'message_room_user');//一番最初がこのモデルと多対多の関係になるモデルであり、次が中間テーブル
   }

   public function messages()
   {
    return $this->hasMany(Message::class);
   }
}
