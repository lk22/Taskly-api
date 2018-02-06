const getters = {
	getAllTasks: state => {
		return state.items
	},
	getSingleTask: state => {
		return state.task
	}
}

export default getters