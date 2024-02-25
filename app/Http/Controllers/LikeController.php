<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function like(Request $request)
  {
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_liked = Like::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_liked) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $like = new Like; //4.Likeクラスのインスタンスを作成
        $like->post_id = $post_id; //Likeインスタンスにreview_id,user_idをセット
        $like->user_id = $user_id;
        $like->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        Like::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $review_likes_count = Post::withCount('likes')->findOrFail($review_id)->likes_count;
    $param = [
        'post_likes_count' => $post_likes_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
  }

  public function index(Request $request)
  {
      $reviews = Review::withCount('likes')->orderBy('id', 'desc')->paginate(10);
      $param = [
          'posts' => $posts,
      ];
      return view('posts.index', $param);
  }

}
