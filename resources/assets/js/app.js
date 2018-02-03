
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// babel polyfills
require("babel-core/register");
require("babel-polyfill");

// window.Vue = require('vue');
import Vue from 'vue'
import request from './helpers/Request'

// views
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'

// main store
import store from './vuex/store'
import router from './router'

// enable Vue.JS Developer tools
Vue.config.devtools = true

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    store,
});