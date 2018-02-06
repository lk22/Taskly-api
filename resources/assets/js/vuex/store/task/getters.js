const getters = {
	getAllTasks: state => {
		return state.tasks
	},
	getSingleTask: state => {
		return state.task
	}
}

export default getters