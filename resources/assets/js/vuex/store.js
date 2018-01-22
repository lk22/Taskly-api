// packages
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// vuex store modules
import auth from './store/auth'

const plugins = []

export const store = () => new Vuex.Store({

	// differen Vuex state modules
	modules: {
		auth,
	},

	// Vuex plugins to use
	plugins: [

		// persist the current state
		createPersistedState({
			key: 'taskly',
			paths: [
				auth,
			]
		})
	],
});