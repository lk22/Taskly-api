import axios from 'axios'


const types = {
	AUTHENTICATE:   'AUTHENTICATE',
	REGISTER: 		'REGISTER',
	FETCH_AUTH: 	'FETCH_AUTH'
};

const auth = {

	/**
	 * Defining default state
	 * @type {Object}
	 */
	state: {
		authenticated: 	{},
		registered: 	null,
	},

	/**
	 * Getter functions
	 * @type {Object}
	 */
	getters: {

		// get the authenticated user
		getAuth: state => {
			return state.authenticated.auth
		},

		// get the authenticated users full name
		fullName: state => {
			return state.authenticated.auth.firstname + ' ' + state.authenticated.auth.lastname 
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
			state.authenticated = user
		},

		/**
		 * Registration mutator
		 */
		[types.REGISTER](state, user) {
			state.registered = user
		},

	},

	/**
	 * Defining Actions for the authenticated user
	 */
	actions: {

		/**
		 * fetch auth
		 */
		getAuth(context) {

			Axios.get('/api/v1/auth').then((auth) => {
				console.log(auth.data)

				const user = auth.data

				context.commit(types.FETCH_AUTH, {
					...user
				});
			}).catch((exception) => {

			})

		},

		/**
		 * Authenticate the user
		 */
		login(context, {
			username, 	// the given username
			password 	// the given password
		}) {

			// send the post request with the given credentials

			axios.post('/api/v1/login', {
				username,
				password
			}).then( (response)  => {

				// log the response from call
				console.log(response)

				const auth = response.data.user.data;
				const token = response.data.token.data.access_token;

				console.log(auth)

				// commit action
				context.commit(types.AUTHENTICATE, {
					auth,
					token
				})

				if(!window.localStorage.getItem('access_token' && !window.localStorage.getItem('authenticated'))){
					window.localStorage.setItem('access_token', token)
					window.localStorage.setItem('authenticated', auth)
				}

				console.log(window.localStorage)

				// extend call
				return Promise.resolve();
			});
		},

		/**
		 * Register new user
		 */
		register(context, {
			firstname,			// users firstname
			lastname,			// users name
			email,				// users email
			password, 			// users password
			confirm_password,	// password confirmation
			has_company,		// if the user has a company
			company_name,		// the company name while the above check is true (has_company)
			company_type, 		// the company type
			company_address,	// the company address
		}) {

			// send request
			axios.post('/api/v1/register', {
				firstname: 			firstname,
				lastname: 			lastname,
				password: 			password,
				confirm_password: 	confirm_password,
				has_company: 		has_company,
				company_name: 		company_name,
				company_type: 		company_type,
				company_address: 	company_address
			}).then( (response) => {

				console.log(response)

				const user = response.data.registratedUser

				context.commit(types.REGISTER, {
					...user
				})

				return Promise.resolve();

			})
		}
	},

	/**
	 * namespacing
	 */
	namespaced: true
}

export default auth