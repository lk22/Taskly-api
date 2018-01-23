
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue'
import VueRouter from 'vue-router'
import Vuex from 'vuex'

// layouts
import App from './views/App.vue'
import Home from './views/Home.vue'

// views
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'

// bind vue router and vuex package
Vue.use(VueRouter)
Vue.use(Vuex)

// define the routers
const router = new VueRouter({
	mode: 'history',
	routes: [
		{ path: '/', 			name: 'home', 		component: require('./views/Home') },
		{ path: '/auth', 		name: 'auth', 		component: require('./views/Authenticate') },
		{ path: '/register', 	name: 'signup', 	component: require('./views/Register') }
	]
})
// const app_router = new VueRouter(AppRouter)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

//homepage instance
const home = new Vue({
  el: '#home',
  router,
})

// const app = new Vue({
//     el: '#app',
//     components: { App },
// });