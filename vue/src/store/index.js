import { createStore } from 'vuex';
import axiosClient from '../axios';

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {
        getUser(state) {
            return state.user;
        }
    },
    mutations: {
        logout(state) {
            state.user.data = {};
            state.user.token = null;
        },
        setUser(state, user) {
            user = user.data;
            state.user.token = user.token;
            state.user.data = user.user;
            sessionStorage.setItem('TOKEN', JSON.stringify(user.token));
        }
    },
    actions: {
        login({ commit }, user) {
            return axiosClient.post('/login', user).then(response => {
                commit('setUser', response);
                return response;
            });
        },
        logout({ commit }) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout');
                    return response;
                })
        }
    },
    modules: {}
})

export default store;
