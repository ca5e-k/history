<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マイホーム
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="flex justify-center mb-4">
           <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">ビジョン</span>
         </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-8">
                <div>
                 @foreach ($lifes as $life)
                 <div class="mb-4 p-4 border-b border-gray-200">
                 <div class="font-bold text-lg mb-2">{{$life->title}}</div> 
                 <div class="border-t border-gray-300 mt-2 mb-2"></div>
                 <div class="text-gray-700 mb-4">{{$life->body}}</div> 
                 <a href="{{ route('life.show', ['life' => $life->id]) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                 </div>
                 @endforeach
                 
                </div>
            </div>

            <div class="flex justify-center mb-4">
             <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">活動実績</span>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                 @foreach ($posts as $post)
                 <div class="mb-4 p-4 border-b border-gray-200">
                 <div class="font-bold text-lg">{{$post->title}}</div> 
                 <div class="border-t border-gray-300 mt-2 mb-2"></div>
                 <div class="text-gray-700 mb-4">{{$post->body}}</div>
                 <a href="{{ route('post.show', ['post' => $post->id]) }}"class="text-blue-500 hover:text-blue-700">詳細を見る</a> 
                 </div>
                 @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<h1>ビジョン</h1>
