/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

import Vue from 'vue';
import store from './store';
import VueRouter from 'vue-router';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: '/admin',
    routes: [
        {
            path: '/login',
            name: 'login',
            component: () => import('@admin/login/LoginComponent'),
            meta: {
                title: 'Administrator Login | ZeroDrop',
            },
        },
        {
            path: '/signup',
            name: 'signup',
            component: () => import('@admin/login/RegisterComponent'),
            meta: {
                title: 'Administrator Signup | ZeroDrop',
            },
        },
        {
            path: '/courses',
            alias: '/',
            name: 'courses',
            component: () => import('@admin/courses'),
            meta: {
                title: 'Courses | ZeroDrop',
            },
        },
        {
            path: '/home',
            name: 'home',
            component: () => import('@admin/pages/home'),
            meta: {
                title: 'Edit Page | ZeroDrop',
            },
        },
        {
            path: '/about',
            name: 'about',
            component: () => import('@admin/pages/about'),
            meta: {
                title: 'Edit Page | ZeroDrop',
            },
        },
        {
            path: '/contact',
            name: 'contact',
            component: () => import('@admin/pages/contact'),
            meta: {
                title: 'Edit Page | ZeroDrop',
            },
        },
        {
            path: '/settings',
            name: 'settings',
            component: () => import('@admin/pages/settings'),
            meta: {
                title: 'Settings | ZeroDrop',
            },
        },
        {
            path: '/team',
            name: 'team',
            component: () => import('@admin/profiles/team'),
            meta: {
                title: 'Team Members | ZeroDrop',
            },
        },
        {
            path: '/administrators',
            name: 'administrators',
            component: () => import('@admin/profiles/administrators'),
            meta: {
                title: 'Administrators | ZeroDrop',
            },
        },
    ],
});

router.beforeEach((to, from, next) => {
    document.title = to.meta.title;
    if (app) {
        app.is_loading = true;
    }
    next();
});

router.afterEach(() => {
    if (app) {
        app.is_loading = false;
    }
});

const app = new Vue({
    el: '#admin-app',
    store,
    router,
    data: {
        is_loading: true,
    },
});

$.extend(true, $.fn.datetimepicker, {
    defaults: {
        icons: {
            time: 'fa fa-clock-o',
            date: 'fa fa-calendar',
            up: 'fa fa-arrow-up',
            down: 'fa fa-arrow-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-calendar-check',
            clear: 'fa fa-trash-alt',
            close: 'fa fa-times-circle',
        },
    },
});
