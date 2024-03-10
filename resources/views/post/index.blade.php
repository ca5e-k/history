<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            みんなの投稿
        </h2>
    </x-slot>
    <div class="mx-auto px-6">
       @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        @foreach($posts as $post)
<div class="mt-4 p-8 bg-white w-full rounded-2xl">
    <div class="flex justify-between items-center p-4">
        <!-- タイトルとLikeボタンとユーザー名を含むFlexコンテナ -->
        <div class="flex items-center justify-start gap-4">
            <h1 class="text-lg font-semibold">
                タイトル：
                <a href="{{ route('post.show', $post) }}" class="text-blue-600">
                {{ $post->title }}
                </a>
            </h1>
            <div class="flex items-center">
                <!-- Like機能 -->
                <span class="mr-2">
                    <img src="{{ asset('img/nicebutton.png') }}" alt="いいね" class="w-6 h-6">
                </span>
                @if(in_array($post->id, $userLikes))
                <!-- 「いいね」取消用フォーム -->
                <form action="{{ route('unlike', $post->id) }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" class="text-xs font-semibold bg-red-500 text-white py-1 px-2 rounded hover:bg-red-600">
                        いいね取り消し
                        <span class="ml-1">{{ $post->likes->count() }}</span>
                    </button>
                </form>
                @else
                <!-- 「いいね」用フォーム -->
                <form action="{{ route('like', $post->id) }}" method="POST" class="flex items-center">
                    @csrf
                    <button type="submit" class="text-xs font-semibold bg-blue-500 text-white py-1 px-2 rounded hover:bg-blue-600">
                        いいね
                        <span class="ml-1">{{ $post->likes->count() }}</span>
                    </button>
                </form>
                @endif
            </div>
        </div>
        <!-- ユーザー名 -->
        <div class="text-sm font-semibold">
        @if($post->user)
            <a href="{{ route('users.posts.show', $post->user->id) }}" class="text-blue-600">
                {{ $post->user->name }}
            </a>
            @else
            匿名
            @endif
        </div>
    </div>
    <hr class="w-full">
    <p class="mt-4 p-4">
        {{$post->body}}
    </p>
</div>
@endforeach

    </div>
</x-app-layout>
