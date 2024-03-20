<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MessageRoom;


class Message extends Model
{
    use HasFactory;

    public function messageRoom()
    {
        return $this->belongsTo(MessageRoom::class);
    }

    protected $fillable = [ //fillableは生成、更新の際に必須!指定ないと他の部分が意図せず更新などされる可能性あり!
        'content',
        'sender_id',
        'receiver_id',
        ];

    public function sender()
    {
    return $this->belongsTo(User::class, 'sender_id');
    } 

    public function receiver()
    {
    return $this->belongsTo(User::class, 'receiver_id');
    }

}
