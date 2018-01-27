
import Axios from 'axios'

const types = {
	AUTHENTICATE:   'AUTHENTICATE',
	REGISTER: 		'REGISTER'
};

const auth = {

	/**
	 * Defining default state
	 * @type {Object}
	 */
	state: {
		authUser: 	null,
		registered: null,
		data: 		{}
	},

	/**
	 * Getter functions
	 * @type {Object}
	 */
	getters: {

		// get the authenticated user
		getAuth: state => {
			return state.authUser
		},

		// get the authenticated users full name
		getFullName: state => {
			return state.data.name
		}

	},

	/**
	 * Mutators
	 */
	mutations: {
		/**
		 * Authentication mutator
		 */
		[types.AUTHENTICATE](state, user) {
			state.authUser = user
		},

		/**
		 * Registration mutator
		 */
		[types.REGISTER](state, user) {
			state.authUser = user
		}
	},

	/**
	 * Defining Actions for the authenticated user
	 */
	actions: {

		/**
		 * Authenticate the user
		 */
		async login(context, {
			username, 	// the given username
			password 	// the given password
		}) {

			// send the post request with the given credentials

				const data = await Axios.post('/login', {
					username,
					password
				})

			// then commit the action to mutator

				.then( (response)  => {

					// log the response from call
					console.log(response)

					const auth = response.data.authUser;

					// commit action
					context.commit(types.AUTHENTICATE, {
						...auth
					})

					// extend call
					return Promise.resolve();
				})

			// or catch the error from response

				.catch( (error) => {
					console.log(error)
				})

		},

		/**
		 * Register new user
		 */
		async register(context, {
			email,				// users email
			username,			// users name
			password,			// users password
			confirm_password	// password confirmation
			// has_company: false,	// if the user has a company
			// company_name: '',	// the company name while the above check is true (has_company)
		}) {

			// send request

				const data = await Axios.post('/register', {
					email,
					username,
					password,
					confirm_password
				})

				// then fetch the response
				.then( (response) => {

					console.log(response)

					const user = response.data.registratedUser

					context.commit(types.REGISTER, {
						...user
					})

					return Promise.resolve();

				})

				// or catch error
				.catch( (error) => {
					console.log(error)
				})

		}
	},

	/**
	 * namespacing
	 */
	namespaced: true
}

export default auth