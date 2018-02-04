import axios from 'axios'
import store from './../vuex/store'

console.log(store.state.auth.authenticated.token)

/**
 * |-------------------------------------------
 * |	Create Request instance
 * |	param: baseUrl
 * |-------------------------------------------
 */
const request = axios.create({
	baseUrl: '/api/v1/'
})

/**
 *|------------------------------------------------------------------
 *| Setup a default request configuration
 *| to setup common request headers
 *| like authentication token and Accept header to only accept json
 *|------------------------------------------------------------------
 */
request.interceptors.request.use((config) => {
	config.headers.common = {
		Authorization: `Bearer ` + store.state.auth.authenticated.auth.token,
		Accept: 'application/json'
	}
	
	return config
}, (error) => {
	return Promise.reject(error);
})

/**
 * |-----------------------------------------------
 * | Setup default Response configuration
 * |-----------------------------------------------
 */
request.interceptors.request.use((response) => {
	return response
}, (error) => {
	return Promise.reject(error)
})

export default request