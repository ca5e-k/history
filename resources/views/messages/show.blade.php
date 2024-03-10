<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>メッセージ交換</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none font-sans">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                メッセージ交換
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="overflow-auto space-y-4 p-4">
                        @foreach ($messages as $message)
                          <div class="flex items-end {{ $message->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                             <div class="{{ $message->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }} max-w-xs lg:max-w-md text-sm p-2 rounded-lg shadow">
                                 <p>{{ $message->content }}</p>
                             </div>
                          </div>
                        @endforeach
                            <div class="flex items-end justify-end">
                                <div class="bg-blue-500 text-white max-w-xs lg:max-w-md text-sm p-2 rounded-lg shadow">
                                    <p>こんにちは！おしゃれなデザインにしてみました。</p>
                                </div>
                            </div>
                            <div class="flex items-end justify-start">
                                <div class="bg-gray-200 text-gray-800 max-w-xs lg:max-w-md text-sm p-2 rounded-lg shadow">
                                    <p>これは素晴らしいですね！使いやすそうです。</p>
                                </div>
                            </div>
                        </div>

                        <!-- メッセージ入力エリア -->
                        <div class="mt-4">
                            <form action="{{ route('messages.send') }}" method="POST">
                                @csrf
                                <div class="flex items-center">
                                    <input type="hidden" name="receiver_id" value="受信者のID">
                                    <input type="text" name="message" placeholder="メッセージを入力してください" class="flex-grow p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow">
                                    <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow">
                                        送信
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
