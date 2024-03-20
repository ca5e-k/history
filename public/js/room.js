function createOrGetRoom(receiverId) {
    fetch('/api/messages/create-or-get-room', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            // 'Authorization': 'Bearer ' + yourAuthToken, // ここに認証トークンを追加
        },
        body: JSON.stringify({
            receiver_id: receiverId
        })
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // ここで、dataに含まれるルーム情報を基に、フロントエンドで何かしらの操作を行います。
        // 例: メッセージページへリダイレクトする、メッセージボックスを表示するなど。
        if(data.room && data.room.id) {
            window.location.href = `/messages/${data.room.id}`; // ルームIDを使ってリダイレクト
        }
    })
    .catch(error => console.error('Error:', error));
}