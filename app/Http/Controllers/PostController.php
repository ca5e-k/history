<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts=Post::all();
        // return view('post.index', compact('posts'));
        $userLikes= Like::where('user_id', auth()->user()->id)
        ->pluck('post_id')->toArray(); // ユーザーがいいねした投稿のIDを取得

        return view('post.index', compact('posts', 'userLikes'));

        // $posts = Post::withCount('likes')->orderBy('id', 'desc')->paginate(10);
        // $param = [
        //     'posts' => $posts,
        // ];
        // return view('posts.index', $param);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);
        $request->session()->flash('message', '保存しました');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // return view('post.show', compact('post'));
        $like=Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('post.show', compact('post', 'like'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|max:20',
            'body' => 'required|max:400',
            ]);
            $validated['user_id'] = auth()->id();
            $post->update($validated);
            $request->session()->flash('message', '更新しました' );
            return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(Request $request,Post $post)
    // {
    //     $post->delete();
    //     $request->session()->flash('message', '削除しました');
    //     return redirect('post');
    // }

    // public function show(Post $post)
    // {  
    //     $nice=Like::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
    //     return view('post.show', compact('post', 'like'));
    // }
}
