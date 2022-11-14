import { createApp } from 'vue'
import store from './store'
import router from './router'
import './style.css'
import './index.css'
import App from './App.vue'

import Pusher from 'pusher-js';


var pusher = new Pusher(process.env.VUE_APP_PUSHER_APP_KEY, {
    cluster: process.env.VUE_APP_PUSHER_APP_CLUSTER
});

var channel = pusher.subscribe('chat');
channel.bind('message-sent', function (data) {
    if (data.user.id == store.state.user.data.id) return;
    store.commit('addMessage', data.message);
});


createApp(App)
    .use(store)
    .use(router)
    .mount('#app')

let user_data = sessionStorage.getItem('user_data');
let token = sessionStorage.getItem('TOKEN');

setData();

async function setData() {

    if (user_data && token) {
        store.commit('setUser', { data: { user: JSON.parse(user_data), token: JSON.parse(token) } });

        await store.dispatch('getMessages');

        window.addEventListener('newMessage', (message) => {
            console.log(message.detail)
            store.commit('addMessage', message.detail);
        })
    }
}
