const getters = {
	getAllTAsks: state => {
		return state.tasks
	},
	getSingleTask: state => {
		return state.task
	}
}

export default getters