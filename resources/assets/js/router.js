import Vue from 'vue'
import VueRouter from 'vue-router'
import store from './vuex/store'

Vue.use(VueRouter)

const router = new VueRouter({
	mode: 'history',
	routes: [
		// homepages routes
		{ 
			path: '/', 
			name: 'home', 
			component: require('./views/Home'), 
			children: [

				/**
				 * Authentication route
				 */
				{ 
					path: '/auth', 
					name: 'auth', 
					component: require('./views/Authenticate'),
					// beforeEnter(to, from, next) {
					// 	if(store.state.auth.authenticated.token){
					// 		next('/app/dashboard/tasks')
					// 	}
					// }
				},

				/**
				 * User registration route
				 */
				{ 
					path: '/signup', 
					name: 'signup', 
					component: require('./views/Register'),
					beforeRouteEnter(to, from, next) {
						if(store.state.auth.authenticated.token){
							next('/app/dashboard/tasks')
						}
					} 
				},
			], 
		},
		
		// dashboard routes
		{ 
			path: '/app/dashboard/',  
			name: 'home-dashboard',	
			component: require('./views/App'), 
			children: [
				{ 
					path: '/app/dashboard/tasks', 
					name: 'dashboard-tasks', 
					component: require('./views/App-tasks') 
				},

				// user settings routes
				{ 
					path: '/app/dashboard/user/:slug/settings', 
					name: 'authenticated-user', 
					component: 
					require('./views/user/Settings'), 
					children: [
					
						// profile settings route 
						{ 
							path: '/app/dashboard/user/:slug/settings/profile', 
							name: 'user-profile-settings', 
							component: require('./views/user/Profile') 
						},

						// company settings route
						{ 
							path: '/app/dashboard/user/:slug/settings/company/:company', 
							name: 'user-company-settings', 
							component: require('./views/user/Company') 
						}
					]
				}
			],
			beforeEnter(to, from, next) {
				if(store.state.auth.authenticated.token) {
					next()
				} else {
					next('/auth')
				}
			}
		}
	]
}) 

export default router