import { createApp } from 'vue'
import store from './store'
import router from './router'
import './style.css'
import './index.css'
import App from './App.vue'

createApp(App)
    .use(store)
    .use(router)
    .mount('#app')


let user_data = sessionStorage.getItem('user_data');
let token = sessionStorage.getItem('TOKEN');

if (user_data && token)
    store.commit('setUser', { data: { user: JSON.parse(user_data), token: JSON.parse(token) } });
