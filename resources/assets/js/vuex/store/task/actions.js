import axios from 'axios'

const actions = {

	/**
	 * get all the tasks
	 */	
	getTasks(context) {
		axios.get('/api/v1/tasks').then((response) => {
			// do something with the response here
			console.log(response)
			
			const payload = response.data.data

			context.commit(types.GET_TASKS, payload)

			return Promise.resolve()
		})
	},

	createTask(context, {
		work_hours,
		weekday,
		week,
		location,
		supplier,
		weekend,
		comment
	}) {
		axios.post('/api/v1/create-task', {
			work_hours: 	work_hours,
			weekday: 		weekday,
			week: 			week,
			location: 		location,
			supplier: 		supplier,
			weekend: 		weekend,
			comment: 		comment
		}).then((response) => {

			console.log(response)

			// do further actions here

			return Promise.resolve()

		})
	}

}