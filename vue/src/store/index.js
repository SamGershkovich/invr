import { createStore } from 'vuex';
import axiosClient from '../axios';

const store = createStore({
    state: {
        user: {
            data: {},
            token: sessionStorage.getItem('TOKEN')
        },
        products: [],
        categories: [],
        sub_categories: [],
        country_of_origins: [],
        productIndex: 0,
        showFilterModal: false,
        showCountModal: false,
        showShrinkModal: false,
        comments: [],
        messages: [],
    },
    getters: {
        showFilterModal: state => state.showFilterModal,
        showCountModal: state => state.showCountModal,
        showShrinkModal: state => state.showShrinkModal,
        productIndex: state => state.productIndex,
        getUser: state => state.user,
        products: state => state.products,
        categories: state => state.categories,
        sub_categories: state => state.sub_categories,
        country_of_origins: state => state.country_of_origins,
        comments: state => state.comments,
        messages: state => state.messages,
    },
    mutations: {
        setMessages(state, messages) {
            state.messages = messages;
        },
        addMessage(state, message) {
            state.messages.push(message);
        },
        setComments(state, comments) {
            state.comments = comments;
        },
        addComment(state, comment) {
            state.comments.push(comment);
        },
        setCategories(state, categories) {
            state.categories = categories.map(c => { return { ...c, selected: false } });
        },
        setSubCategories(state, sub_categories) {
            state.sub_categories = sub_categories.map(c => { return { ...c, selected: false } });
        },
        setCountryOfOrigins(state, country_of_origins) {
            function capitalizeWords(arr) {
                return arr.map(element => {
                    return element.charAt(0).toUpperCase() + element.slice(1).toLowerCase();
                });
            }
            state.country_of_origins = country_of_origins.map(c => { return { ...c, name: capitalizeWords(c.name.split(" ")).join(" "), selected: false } });
        },
        toggleCategory(state, index) {
            state.categories[index].selected = !state.categories[index].selected;
        },
        toggleSubCategory(state, index) {
            state.sub_categories[index].selected = !state.sub_categories[index].selected;
        },
        toggleCountry(state, index) {
            state.country_of_origins[index].selected = !state.country_of_origins[index].selected;
        },
        setShowFilterModal(state, payload) {
            state.showFilterModal = payload;
        },
        setShowCountModal(state, payload) {
            state.showCountModal = payload;
        },
        setShowShrinkModal(state, payload) {
            state.showShrinkModal = payload;
        },
        setProductIndex(state, index) {
            state.productIndex = index;
        },
        setProducts(state, products) {
            state.products = products;
        },
        setProduct(state, product) {
            state.products[state.products.findIndex(p => p.id == product.id)] = product;
        },
        logout(state) {
            state.user.data = {};
            state.user.token = null;
            sessionStorage.removeItem('TOKEN');
        },
        setUser(state, user) {
            user = user.data;
            state.user.token = user.token;
            state.user.data = user.user;
            sessionStorage.setItem('TOKEN', JSON.stringify(user.token));
            sessionStorage.setItem('user_data', JSON.stringify(user.user));
        }
    },
    actions: {
        getMessages({ commit }) {
            axiosClient.get(`/messages`)
                .then(res => {
                    commit('setMessages', res.data.messages);
                    return res.data.messages;
                })
        },
        addMessage({ commit, state }, content) {
            if (content.content.trim() == '') return;
            axiosClient.post(`/addMessage`, {
                user_id: state.user.data.id,
                content: content.content
            }
            ).then(res => {
                commit('addMessage', res.data.messages[0]);
            })
        },
        getComments({ commit, state }) {
            if(state.products.length == 0) return;
            axiosClient.get(`/comments`, { params: { inventory_id: state.products[state.productIndex].inventory_id } })
                .then(res => {
                    commit('setComments', res.data.comments);
                    return res.data.comments;
                })
        },
        addComment({ commit, state }, content) {
            axiosClient.post(`/addComment`, {

                user_id: state.user.data.id,
                product_id: state.products[state.productIndex].id,
                inventory_id: state.products[state.productIndex].inventory_id,
                content: content.content
            }
            ).then(res => {
                commit('addComment', res.data.comments[0]);
            })
        },
        saveShrink({ dispatch }, shrink) {
            return axiosClient.post('/shrink/update', shrink).then(response => {
                dispatch('searchProducts', { id: shrink.id });
                return response;
            });
        },
        saveInventory({ dispatch }, inventory) {
            return axiosClient.post('/inventory/update', inventory).then(response => {
                dispatch('searchProducts', { id: inventory.id });
                return response;
            });
        },
        login({ commit, dispatch }, user) {
            return axiosClient.post('/login', user).then(response => {
                commit('setUser', response);
                dispatch('getMessages');
                return response;
            });
        },
        logout({ commit }) {
            return axiosClient.post('/logout')
                .then(response => {
                    commit('logout');
                    return response;
                })
        },
        loadData({ commit }) {
            axiosClient.get('/categories').then(response => {
                commit('setCategories', response.data.categories);
            });
            axiosClient.get('/sub_categories').then(response => {
                commit('setSubCategories', response.data.sub_categories);
            });
            axiosClient.get('/country_of_origins').then(response => {
                commit('setCountryOfOrigins', response.data.country_of_origins);
            });
            return true;
        },
        searchProducts({ commit, state, dispatch }, { query = undefined, id = undefined }) {

            let categories = [];
            let sub_categories = [];
            let country_of_origins = [];

            state.categories.forEach(c => {
                if (c.selected) categories.push(c.id);
            });
            state.sub_categories.forEach(c => {
                if (c.selected) sub_categories.push(c.id);
            });
            state.country_of_origins.forEach(c => {
                if (c.selected) country_of_origins.push(c.id);
            });

            if (id) {
                axiosClient.get('/products', { params: { id, categories: JSON.stringify(categories), sub_categories: JSON.stringify(sub_categories), country_of_origins: JSON.stringify(country_of_origins) } }).then(response => {
                    commit('setProduct', response.data.products[0]);
                    dispatch('getComments');
                    return response.data.products[0];
                });
            } else {
                axiosClient.get('/products', { params: { query, categories: JSON.stringify(categories), sub_categories: JSON.stringify(sub_categories), country_of_origins: JSON.stringify(country_of_origins) } }).then(response => {
                    commit('setProducts', response.data.products);
                    dispatch('getComments');
                    return response.data.products;
                });
            }
        },
    },
    modules: {}
})

export default store;
