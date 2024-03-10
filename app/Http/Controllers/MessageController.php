<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create($id)
    {
        $user = User::find($id);
        return view('messages.show', compact('user'));
    }

    public function send(Request $request)
    {
        // バリデーション
        $request->validate([
            'message' => 'required|string|max:255', // 必要に応じてバリデーションルールを調整
            'receiver_id' => 'required|integer', // 受信者IDが必須かつ整数であることを確認
        ]);

        $receiverId = $request->input('receiver_id'); // フォームから受信者IDを取得
        
        // メッセージをデータベースに保存
        $message = new Message();
        $message->content = $request->message;
        $message->sender_id = auth()->id(); // 送信者のID（認証ユーザーのIDを使用）
        $message->receiver_id = $receiverId; // 受信者IDを設定
        // 他に必要なフィールドがあればここで設定
        $message->save();

        // メッセージ送信後のリダイレクト先（例：メッセージ一覧ページ）
        return redirect()->route('messages.create')->with('success', 'メッセージを送信しました。');
    }
}
