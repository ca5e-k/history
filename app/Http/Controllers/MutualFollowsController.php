<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class MutualFollowsController extends Controller
{
    public function index()
    {
        $user = Auth::user();// ログインユーザー情報を変数に代入
        $mutualFollows = $user->mutualFollows();//相互フォローユーザーの取得

        return view('mutual_follows.index', compact('mutualFollows'));
    }
}
