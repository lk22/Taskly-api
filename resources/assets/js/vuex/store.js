// packages
import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from 'vuex-persistedstate'
import Superstore from 'vuex-superstore'
import * as Cookies from 'js-cookie'

// vuex store modules
import auth from './store/auth'
import task from './store/task'

const plugins = []

Vue.use(Vuex)

const debug = process.env.NODE_ENV !== 'production'

// const superstore = new Superstore()

const store = new Vuex.Store({

	// different Vuex state modules
	modules: {
		auth,
		task
	},
	plugins: [
	// superstore.save()

		createPersistedState({
			key: 'taskly',
			paths: [
				'auth',
				'task'
			]
		})
	],


});

export default store