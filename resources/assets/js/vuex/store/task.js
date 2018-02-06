
import types from './task/types'
import actions from './task/actions'
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