import request from './../../../helpers/Request'
import types from './types'

const actions = {

	/**
	 * get all the tasks
	 */	
	getTasks(context) {
		request.get('/api/v1/tasks').then((response) => {
			// do something with the response here
			console.log(response)
			
			const payload = response.data.data

			context.commit(types.GET_TASKS, payload)

			return Promise.resolve()
		}).catch((error) => {
			return Promise.reject()
		})
	},

	/**
	 * Create a new task
	 * @param  {[type]} context            [description]
	 * @param  {[type]} options.work_hours [description]
	 * @param  {[type]} options.weekday    [description]
	 * @param  {[type]} options.week       [description]
	 * @param  {[type]} options.location   [description]
	 * @param  {[type]} options.supplier   [description]
	 * @param  {[type]} options.weekend    [description]
	 * @param  {[type]} options.comment    [description]
	 * @return {[type]}                    [description]
	 */
	createTask(context, {
		work_hours,
		weekday,
		week,
		location,
		supplier,
		weekend,
		comment
	}) {
		request.post('/api/v1/create-task', {
			work_hours: 	work_hours,
			weekday: 		weekday,
			week: 			week,
			location: 		location,
			supplier: 		supplier,
			weekend: 		weekend,
			comment: 		comment
		}).then((response) => {

			console.log(response)

			// // do further actions here
			// const work_hours = work_hours
			// const weekday = weekday
			// const week = week
			// const location = location
			// const supplier = supplier
			// const weekend = weekend
			// const comment = comment
			
			// context.commit(types.CREATE_TASK, {
			// 	work_hours,
			// 	weekday,
			// 	week,
			// 	location,
			// 	supplier,
			// 	weekend,
			// 	comment
			// })

			// extend Promise call
			return Promise.resolve()

		}).catch((err) => {
			return Promise.reject()
		})
	},

	setPriority(context, {
		id,
		priority
	}) {

		axios.patch('/api/v1/tasks/' + id + '/set-priority', {
			priority: priority
		}).then((response) => {

			// debug response
			console.log(response)

			const id = id
			const priority = priority

			// commit action
			context.commit(types.SET_PRIORITY, {
				id,
				priority
			})

			return Promise.resolve()

		}).catch((error) => {
			return Promise.reject()
		})

	},

	setWorkhours(context, {
		id,
		work_hours
	}) {

		axios.patch('/api/v1/tasks/' + id + '/set-workhour', {
			work_hours: work_hours
		}).then((response) => {

			console.log(response)

			const id = id
			const work_hours = work_hours

			context.commit(types.SET_WORK_HOURS, {
				id,
				work_hours
			})

			return Promise.resolve()

		}).catch((error) => {
			return Promise.reject()
		})

	}

}

export default actions