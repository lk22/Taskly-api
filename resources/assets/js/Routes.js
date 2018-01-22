
import Authenticate from './views/Authenticate.vue'
import Register from './views/Register.vue'

export const HomeRouter = {
	mode: 'history',
	routes: [
		// authentication route
		{
			path: '/auth',
			name: 'authentication',
			component: Authenticate
		},
	]
}