<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            マッチングユーザー
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex flex-col">
                        @foreach ($mutualFollows as $user)
                            <div class="p-4 mb-4 bg-gray-100 rounded shadow-sm">
                                <p class="text-lg font-semibold">{{ $user->name }}</p>
                                <a href="{{ route('messages.create', ['user' => $user->id]) }}" class="text-blue-500 hover:text-blue-800">メッセージを送る</a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

