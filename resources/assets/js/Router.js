import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Home from './views/Home.vue'
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'

export const router = new VueRouter({
	mode: 'history',
	routes: [

		// authentication route
		{
			path: '/auth',
			name: 'authentication',
			component: Authenticate
		},

		// user registration route
		{
			path: '/register',
			name: 'registration',
			component: Register
		},

		// dashboard main route
		// {
		// 	path: '/app/dashboard',
		// 	name: 'dashboard',
		// 	component: Dashboard,
		// 	children: [

		// 		// tasks path
		// 		{
		// 			path: '/tasks',
		// 			name: 'tasks',
		// 			component: Tasklist
		// 		},

		// 		// settings path 
		// 		{
		// 			path: '/user'
		// 		}
		// 	]
		// },
	]
})