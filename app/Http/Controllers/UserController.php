<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Life;
use App\Models\User;


class UserController extends Controller
{
    public function showPosts($user)
{
    $user = User::findOrFail($user);
    $lifes = $user->lifes()->get();
    $posts = $user->posts()->get();

    return view('users.posts.index', compact('user', 'lifes', 'posts'));
}
}
