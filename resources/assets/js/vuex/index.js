// packages
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'

// vuex store modules
import auth from './store/auth'

const plugins = []

Vue.use(Vuex)

// const debug = process.env.NODE_ENV !== 'production'

const store = new Vuex.Store({

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

export default store