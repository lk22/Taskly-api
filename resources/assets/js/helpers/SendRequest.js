import request from './Request.js'

const SendRequest = (method, uri, parameters = {}) => {
	if( method === 'GET' ) { 
		return request.get(uri) 
	}

	return request.method(uri, parameters)
}

export default SendRequest