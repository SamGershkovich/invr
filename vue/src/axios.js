import axios from 'axios'
import store from './store'

const axiosClient = axios.create({
    baseURL: import.meta.env.VITE_MIX_API_URL
})


axiosClient.interceptors.request.use(config => {
    const token = store.state.user.token;
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
})

export default axiosClient