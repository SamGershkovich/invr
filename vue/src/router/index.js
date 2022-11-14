import { createRouter, createWebHistory } from "vue-router";
import invrDashboard from "../views/invrDashboard.vue";
import invrReports from "../views/invrReports.vue";
import invrLogin from "../views/invrLogin.vue";
import DefaultLayout from "../components/DefaultLayout.vue";
import AuthLayout from "../components/AuthLayout.vue";
import store from "../store";
const routes = [
    {
        path: '/',
        redirect: 'dashboard',
        name: 'Dashboard',
        meta: { requiresAuth: true },
        component: DefaultLayout,
        children: [
            {
                path: '/dashboard',
                name: 'Dashboard',
                component: invrDashboard,
            },
            {
                path: '/reports',
                name: 'Reports',
                component: invrReports,
            }],
    },
    {
        path: '/auth',
        redirect: "login",
        name: 'Auth',
        component: AuthLayout,
        meta: { isGuest: true },
        children: [
            {
                path: '/login',
                name: 'Login',
                component: invrLogin
            }
        ]
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
})

router.beforeEach((to, from, next) => {
    if (to.meta.requiresAuth && !store.state.user.token) {
        next('/login');
    } else if (store.state.user.token && to.meta.isGuest) {
        next('/dashboard');
    } else {
        next();
    }
})

export default router