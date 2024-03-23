import './bootstrap';
import Alpine from 'alpinejs';
// import { scrollToBottom } from './scrollToBottom';
import './message';

require('./bootstrap');
// require('./follow');

// DOMが読み込まれた後にスクロールを最下部に移動させる
// document.addEventListener('DOMContentLoaded', () => {
//     scrollToBottom();
// });

window.Alpine = Alpine;

Alpine.start();
