import {createRouter, createWebHistory} from "vue-router";

import cookieServices from "../apiController/cookieServices.js";

import authLayout from "../authentication/layout/layout.vue";
import login from "../authentication/pages/login.vue";
import registration from "../authentication/pages/registration.vue";
import forgot from "../authentication/pages/forgot.vue";
import reset from "../authentication/pages/reset.vue";
import verification from "../authentication/pages/verification.vue";

import portalLayout from "../portal/layout/layout.vue";
import home from "../portal/pages/home.vue";
import profile from "../portal/pages/profile.vue";

const title = 'Crud - ';

const routes = [
    {
        path: '/auth', name: 'authLayout', component: authLayout,
        children: [
            { path: 'login', name: 'login', component: login, meta: { title: + 'Login' } },
            { path: 'registration', name: 'registration', component: registration, meta: { title: + 'Registration' } },
            { path: 'forgot', name: 'forgot', component: forgot, meta: { title: + 'Forgot' } },
            { path: 'reset', name: 'reset', component: reset, meta: { title: + 'Reset' } },
            { path: 'verification', name: 'verification', component: verification, meta: { title: + 'Verification' } },
        ]
    },
    {
        path: '/', name: 'portalLayout', component: portalLayout,
        children: [
            { path: '', name: 'home', component: home, meta: { title: title + 'Home' } },
            { path: 'profile', name: 'profile', component: profile, meta: { title: title + 'Profile' } },
        ]
    },
];
const router = createRouter({
    history: createWebHistory(), routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth',
            };
        } else {
            return {top: 0, behavior: 'smooth'};
        }
    }
});
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!cookieServices.get('access_token');
    if (to.matched.some(record => record.name === 'authLayout')) {
        if (isAuthenticated) {
            next({name: 'dashboard'});
        } else {
            next();
        }
    } else if (to.matched.some(record => record.name === 'portalLayout')) {
        if (!isAuthenticated) {
            next({name: 'login'});
        } else {
            next();
        }
    } else {
        next();
    }
});
export default router;
