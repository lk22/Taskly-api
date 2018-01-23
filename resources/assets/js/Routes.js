
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'
import Home from './views/Home.vue'

export const HomeRouter = {
	mode: 'history',
	routes: [
		// home route
		{
			path: '/',
			name: 'home',
			compoennt: Home
		},

		// auth route
		{
			path: '/auth',
		    name: 'authentication',
		    component: Authenticate
		},

		// registration route
		{
			path: '/signup',
			name: 'registration',
			component: Register
		}
	]
}