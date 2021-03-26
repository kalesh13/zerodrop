/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.use(VueRouter);

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('@pages/home'),
    },
    {
      path: '/courses',
      name: 'courses',
      component: () => import('@pages/courses'),
    },
  ],
});

router.afterEach(() => {
  if (app) {
    app.is_loading = false;
  }
});

const app = new Vue({
  el: '#app',
  router: router,
  data: {
    is_loading: true,
  },
});
