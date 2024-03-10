// document.addEventListener('DOMContentLoaded', function() {
//     document.querySelectorAll('.follow-action').forEach(button => {
//         button.addEventListener('click', function() {
//             const userId = this.getAttribute('data-user-id');
//             const action = this.getAttribute('data-action');
//             const url = `/` + action + `/${userId}`;
//             const method = action === 'follow' ? 'POST' : 'DELETE';

//             fetch(url, {
//                 method: method,
//                 headers: {
//                     'Content-Type': 'application/json',
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
//                 },
//                 body: JSON.stringify({ userId: userId })
//             })
//             .then(response => response.json())
//             .then(data => {
//                 if(data.success) {
//                     // 成功時の処理: ボタンのテキストとアクションを切り替える
//                     this.textContent = action === 'follow' ? 'フォロー解除' : 'フォローする';
//                     this.setAttribute('data-action', action === 'follow' ? 'unfollow' : 'follow');
//                 }
//             })
//             .catch(error => console.error('Error:', error));
//         });
//     });
// });
