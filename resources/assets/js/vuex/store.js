// packages
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import * as Cookies from 'js-cookie'

// vuex store modules
import auth from './store/auth'

const plugins = []

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

const store = new Vuex.Store({

	// different Vuex state modules
	modules: {
		auth,
	},
	plugins: [
		createPersistedState({
			key: 'taskly',
			paths: [
				'auth'
			]
		})
	],

});

export default store