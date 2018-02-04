/**
 * Mutations for a task
 * @type {Object}
 */
const mutations = {

	/**
	 * get all tasks
	 */
	[types.GET_TASKS]

	/** 
	 * Creating a new task
	 */
	[types.CREATE_TASK](state, task) {
		state.items = [task].concat(state.items)
	},

	/**
	 * removing task
	 * @type {Boolean}
	 */
    [types.DELETE_TASK](state, task) {
		state.items = state.items.filter(item => item.id !== task.id)
	},

	/**
	 * Completing a new task
	 */
	[types.COMPLETE_TASK](state, task){
		state.task.completed !== task.completed
	},

	/**
	 * Complete all the tasks
	 */
	[types.COMPLETE_ALL_TASKS](state, items) {
		state.items = state.items.filter(
		    item => item.is_checked !== task.is_checked
		)	
	},

	/**
	 * Update a existing task
	 */
	[types.UPDATE_TASK](state, payload) {
		payload.task = Object.assign(payload.task, payload.update);
	},

	/** 
	 * Updating priority for a task
	 */
	[types.SET_PRIORITY](state, task) {
		const { priority } = payload
		state.items.filter(
		    item => item.priority === task.priority
		)
	},

	/**
	 * updating work hours on a task
	 */
	[types.SET_WORK_HOURS](state, task) {
		const { work_hours } = task
		state.items.filter(
			item => item.work_hours === task.work_hours
		)
	},

	/**
	 * updating deadline for a task
	 */
	[types.SET_DEADLINE](state, task) {
		const { dealine } = payload
		state.items.filter(
			item => item.deadline === task.deadline
		)
	}
}

export default mutations