import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import SendMessage from './components/SendMessage.vue';
import ChatMessage from './components/ChatMessage.vue';
import ChatDetail from './components/ChatDetail.vue';
import ChatContact from './components/ChatContact.vue';
const app=createApp({
    components:{
        SendMessage,
        ChatMessage,
        ChatDetail,
        ChatContact,
    }
});
app.mount('#app');

window.Alpine = Alpine;

Alpine.start();
