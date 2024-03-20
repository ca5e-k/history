// document.addEventListener('DOMContentLoaded', function () {
//     const sendMessageForm = document.querySelector('form'); // 送信フォームを選択
//     sendMessageForm.addEventListener('submit', function (e) {
//         e.preventDefault(); // フォームのデフォルト送信を防止

//         const formData = new FormData(this); // フォームのデータを取得
//         fetch(this.action, {
//             method: 'POST',
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest',
//                 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//             },
//             body: formData
//         })
//         .then(response => response.json())
//         .then(data => {
//             console.log(data); // レスポンスをコンソールに表示
//             // ここでメッセージを画面に追加する処理を書く
//         })
//         .catch(error => console.error('Error:', error));
//     });
// });
