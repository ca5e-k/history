<!-- <meta name="csrf-token" content="{{ csrf_token() }}"></meta>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        一覧表示
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
            <h1 class="p-4 text-lg font-semibold">
             件名：
                <a href="{{route('post.show', $post)}}" class="text-blue-600">
                    {{$post->title}}
                </a>
            </h1>
            <hr class="w-full">
            <p class="mt-4 p-4">
                {{$post->body}}
            </p>
            <div class="p-4 text-sm font-semibold">
                <p>
                {{$post->created_at}}　/　 {{$post->user->name??'匿名'}}
                </p>
            </div>
        </div>
    @endforeach
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@auth
        <!-- Reviewモデルに作ったisLikedByメソッドをここで使用 -->
        @if (!$post->isLikedBy(Auth::user()))
                <span class="likes">
                    <i class="fas fa-music like-toggle" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{ $post->likes_count }}</span>
                </span><!-- /.likes -->
            @else
                <span class="likes">
                    <i class="fas fa-music heart like-toggle liked" data-post-id="{{ $post->id }}"></i>
                    <span class="like-counter">{{ $post->likes_count }}</span>
                </span><!-- /.likes -->
            @endif
@endauth
    @guest
    <span class="likes">
        <i class="fas fa-music heart"></i>
        <span class="like-counter">{{$item->likes_count}}</span>
    </span><!-- /.likes -->
    @endguest
</x-app-layout>

<script src="like.js"></script>