<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use App\Models\MessageRoom;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    
        public function createOrGetRoom(Request $request)
        {
            $userId = $request->user()->id; // 認証されたユーザーのID
            $receiverId = $request->receiver_id; // フロントエンドから受け取る、メッセージを受け取るユーザーのID

            $room = MessageRoom::createOrGetRoom($userId, $receiverId);

            return response()->json([
                'room' => $room,
            ]);
        }

        public function show($roomId)
        {
            $userId = auth::id();
            $receiver_id = MessageRoom::find($roomId)
            ->users()
            ->where('user_id', '!=', $userId)
            ->firstOrFail()
            ->id;
            $messages = Message::where('message_room_id', $roomId)->with('sender')->get();
            return view('messages.show', compact('messages', 'roomId','receiver_id'));
        }


        public function send(Request $request, $roomId)
        {
         $message = new Message;
         $message->message_room_id = $roomId;
         $message->sender_id = auth()->id();
         $message->receiver_id = $request->receiver_id;
         $message->content = $request->message; 
         $message->save();
    
         return redirect()->route('messages.show', ['roomId' => $roomId]);
        }

        // public function getMessages($roomId)
            // {
            //  $messages = Message::where('message_room_id', $roomId)
            //                     ->with('user') // メッセージを送信したユーザーの情報も取得
            //                     ->get();

            //  return response()->json([
            //     'messages' => $messages,
            //  ]);
            // }


}
