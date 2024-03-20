<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\MessageRoom;


// UserデータベースとMessage_roomデータベースの多対多のための機能
class MessageRoomUser extends Model
{
    use HasFactory;
}
