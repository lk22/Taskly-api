<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

use Taskly\Transformers\UserTransformer;
use Taskly\Transformers\UsersTransformer;
use Illuminate\Support\Facades\Route;

use GuzzleHttp\Client;

use Taskly\User;
use Taskly\Company;

class UserController extends Controller
{
	/**
     * |-----------------------------------------------------------------
	 * |   Constructor
	 * |   @param User $user [description]
     * |-----------------------------------------------------------------
	 */
    public function __construct(User $user)
    {
    	$this->user = $user;
    }

    /**
     * |--------------------------------------------------------------------
     * |    giver user access to API
     * |    @param  Request $request [description]
     * |    @return [type]           [description]
     * |--------------------------------------------------------------------
     */
    public function login(Request $request)
    {

        /**
         * Validating request
         */
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        /**
         * add a request to save within other api requests
         */
        $request->request->add([
            'username'          => $request->username,
            'password'          => $request->password,
            'grant_type'        => 'password',
            'client_id'         => env('PASSPORT_CLIENT_ID', 1),
            'client_secret'     => env('PASSPORT_CLIENT_SECRET', ''),
            'scope'             => '*'
        ]);

        /**
         * adding oauth/token endpoint to Routes group
         * @var [type]
         */
        $proxy = Request::create('/oauth/token', 'POST');

        /**
         * Dispatch the creationg of the route creation
         * @var [type]
         */
        $response = Route::dispatch($proxy);


        /**
         * casting the content to JSON
         * @var [type]
         */
        $jsonResponse = (array) json_decode($response->getContent());

        if(array_key_exists('error', $jsonResponse)) {
            return response()->json([
                'message' => $jsonResponse['message']
            ], 322);
        }

        /**
         * Fetch the authenticated user
         */
        try {

            /**
             * get user
             * @var [type]
             */
            $user = $this->user->whereEmail($request->input('username'))->firstOrFail();

            /**
             * transform the user
             * @var [type]
             */
            $profile = fractal()->item($user, new UserTransformer());

            /**
             * Define Success response to get in return 
             * @var [type]
             */
            $successResponse = [
                'token' => [
                  'data' => [
                    'token_type' => $jsonResponse['token_type'],
                    'expires_in' => $jsonResponse['expires_in'],
                    'access_token' => $jsonResponse['access_token'],
                    'refresh_token' => $jsonResponse['refresh_token']
                  ]
                ],
                'user' => $profile
            ];       

            /**
             * give the success response bace in return
             */
            return response()->json($successResponse);

       } catch (ModelNotFoundException $exception) {
            /**
             * if the request fails and user is not found then throw a model not found exception back to the client
             */
            return $exception;
       }
    }

    /**
     * |-----------------------------------------------------------------------------------
     * |    registration authentication through passport
     * |    @param  Request $request [description]
     * |    @return [type]           [description]
     * |-----------------------------------------------------------------------------------
     */
    public function register(Request $request)
    {

        // dd($request->all());

        /**
         * Validating request input
         * @var [type]
         */
        $validator = $request->validate([
            'firstname'         => 'required',
            'lastname'          => 'required',
            'email'             => 'required|email|unique:users',
            'password'          => 'required',
            'confirm_password'  => 'required|same:password',
            'has_company'       => ''
        ]);

        if($request->input('has_company')) {
            $company_validation = $request->validate([
                'company_name'              => 'required',
                'company_type'              => 'required',
                'company_address'           => '',
            ]);
        }

        /**
         * check for failing request
         */
        if ($validator->fails() || $company_validation->falis()) {
            return response()->json([
                'error' => 'Something went wrong with your request'
            ]);
        }

        /**
         * Creating new user from request input
         * @var [type]
         */
        $user = User::create([
          'firstname'       => $request->get('firstname'),
          'lastname'        => $request->get('lastname'),
          'name'            => $request->get('firstname') . ' ' . $request->get('lastname'),
          'slug'            => strtolower($request->get('firstname')) . '-' . strtolower($request->get('lastname')),
          'email'           => $request->input('email'),
          'password'        => bcrypt($request->get('password')),
          'has_company'     => $request->get('has_company')
        ]);

        if($user->has_company = true) {
            Company::create([
                'company_name'      => $request->get('company_name'),
                'company_type'      => $request->get('company_type'),
                'company_address'   => $request->get('company_address')
            ]);
        }

        // Sign the user in
        $http = new GuzzleHttp\Client;

        // sending the requesting information to passport token endpoint
        $response = $http->post(URL::to('/oauth/token'), [
          'form_params'         => [
            'grant_type'        => 'password',
            'client_id'         => env('PASSPORT_CLIENT_ID', 1),
            'client_secret'     => env('PASSPORT_CLIENT_SECRET', ''),
            'username'          => $request->input('email'),
            'password'          => $request->input('password'),
            'scope'             => '*'
          ]
        ]);

        // defining response
        $jsonResponse = json_decode((string) $response->getBody(), true);

        // fetching user
        $profile = fractal()->item($user, new UserTransformer());

        // defining success response
        $successResponse = [
            'token' => [
              'data' => [
                'token_type' => $jsonResponse['token_type'],
                'expires_in' => $jsonResponse['expires_in'],
                'access_token' => $jsonResponse['access_token'],
                'refresh_token' => $jsonResponse['refresh_token']
              ]
            ],
            'user' => $profile,
          ];

          // giving success response in return to client
          return response()->json($successResponse);
    }
}
