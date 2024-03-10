<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Life;
use App\Models\post;

class HomeController extends Controller
{
    public function index()
    {    
        $user = auth()->user();
        $lifes = $user->lifes()->get(); // ユーザーに関連するlifesを取得
        $posts = $user->posts()->get(); // ユーザーに関連するpostsを取得
    return view('home', compact('lifes','posts')); // 取得したデータをビューに渡す
    }
}
