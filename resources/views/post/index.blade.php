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
                    {{$post->created_at}}　/　{{$post->user->name ?? '匿名'}}
                </p>
            </div>
            
            <span>
                <img src="{{ asset('img/nicebutton.png') }}" width="30px">
                @if(in_array($post->id, $userLikes))
                <!-- 「いいね」取消用フォーム -->
                <form action="{{ route('unlike', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm">
                        いいね取り消し
                        <span class="badge">{{ $post->likes->count() }}</span>
                    </button>
                </form>
                @else
                <!-- 「いいね」用フォーム -->
                <form action="{{ route('like', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">
                        いいね
                        <span class="badge">{{ $post->likes->count() }}</span>
                    </button>
                </form>
                @endif
            </span>
        </div>
    @endforeach
    </div>
</x-app-layout>
