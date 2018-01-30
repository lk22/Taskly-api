
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
import Vuex from 'vuex'
import VueRouter from 'vue-router'
import axios from 'axios'

// layouts
// import App from './views/App'

// views
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'

// main store
import Store from './vuex'

// bind vue packages
Vue.use(VueRouter)
Vue.use(Vuex)

// enable Vue.JS Developer tools
Vue.config.devtools = true

// define the routers
const router = new VueRouter({
	mode: 'history',
	routes: [
		// homepages routes
		// { path: '/', 				name: 'home', 		component: require('./views/Home') },
		// { path: '/auth', 			name: 'auth', 		component: require('./views/Authenticate') },
		// { path: '/signup', 			name: 'signup', 	component: require('./views/Register') },
		
		// dashboard routes
		{ path: '/app/dashboard/',  name: 'home-dashboard',	component: require('./views/App'), children: [
			{ path: '/app/dashboard/tasks', name: 'dashboard-tasks', component: require('./views/App-tasks') },

			// user settings routes
			{ path: '/app/dashboard/user/:slug/settings', name: 'authenticated-user', component: require('./views/user/Settings'), children: [
				
				// profile settings route
				{ path: '/app/dashboard/user/:slug/settings/profile', 	name: 'user-profile-settings', component: require('./views/user/Profile') },

				// company settings route
				{ path: '/app/dashboard/user/:slug/settings/company/:company', name: 'user-company-settings', component: require('./views/user/Company') }
			]}
		]}
	]
}) 

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
    Store
});