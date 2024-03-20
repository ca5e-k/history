<?php

namespace App\Models;
use App\Models\User;
use App\Models\Message;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class MessageRoom extends Model
{
    use HasFactory;

    public function users()
   {
    return $this->belongsToMany(User::class, 'message_room_user');
   }

   public function messages()
   {
    return $this->hasMany(Message::class);
   }

   public static function createOrGetRoom($userId, $receiverId)
{
    // まず、ユーザー間のメッセージルームが存在するか確認
    $room = MessageRoom::whereHas('users', function ($query) use ($userId, $receiverId) {
        $query->whereIn('users.id', [$userId, $receiverId]);
    })->with('users')->get()->filter(function ($room) use ($userId, $receiverId) {
        // 2ユーザーのみがルームに参加しているか確認
        return $room->users->pluck('id')->sort()->values()->all() === collect([$userId, $receiverId])->sort()->values()->all();
    })->first();

    // ルームが存在しなければ、新しく作成
    if (!$room) {
        $room = MessageRoom::create();
        $room->users()->attach([$userId, $receiverId]);
    }

    return $room;
}

}
