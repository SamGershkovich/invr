import axios from 'axios'
import store from './store'

const axiosClient = axios.create({
    baseURL: process.env.VUE_APP_API_URL
})


axiosClient.interceptors.request.use(config => {
    const token = store.state.user.token;
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
})

export default axiosClient