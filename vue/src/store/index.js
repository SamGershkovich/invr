import { createStore } from 'vuex';

const store = createStore({
    state: {
        user: {
            data: { name: 'Sam' },
            token: null
        }
    },
    getters: {},
    mutations: {},
    actions: {},
    modules: {}
})

export default store;
