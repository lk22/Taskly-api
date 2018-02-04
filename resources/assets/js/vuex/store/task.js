
import types from './task/types'
// import the actions here
import mutations from './task/mutations'
import getters from './task/getters'
import state from './task/state'

const task = {
	state,
	mutations,
	getters,
	namespaced: true
}

export default task