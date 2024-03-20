// // 特定のユーザーとのメッセージルームを取得
// function getRoom(receiverId) {
//     fetch(`/api/room/${receiverId}`)
//         .then(response => response.json())
//         .then(data => {
//             console.log(data);
//             // ここでメッセージルームのデータをDOMに追加する処理を行う
//         });
// }

// // ルーム内のメッセージを取得
// function getMessages(roomId) {
//     fetch(`/api/messages/${roomId}`)
//         .then(response => response.json())
//         .then(data => {
//             console.log(data);
//             // ここで取得したメッセージをDOMに追加する処理を行う
//         });
// }

// document.addEventListener('DOMContentLoaded', function() {
//     const sendMessageForm = document.querySelector('form');
//     sendMessageForm.addEventListener('submit', function(e) {
//         e.preventDefault(); // フォームのデフォルトの送信動作を阻止

//         const receiverId = this.querySelector('input[name="receiver_id"]').value;
//         const messageContent = this.querySelector('input[name="message"]').value;

//         // ここでAjaxリクエストを送信する
//         fetch('{{ route('messages.send') }}', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // CSRFトークンをヘッダに含める
//             },
//             body: JSON.stringify({
//                 receiver_id: receiverId,
//                 message: messageContent
//             })
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log(data);
//             // 成功した場合、メッセージリストに新しいメッセージを追加する等の処理
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });

