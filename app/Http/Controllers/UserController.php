<?php

namespace Taskly\Http\Controllers;

use Illuminate\Http\Request;

use Taskly\Transformers\UserTransformer;
use Taskly\Transformers\UsersTransformer;
use Illuminate\Support\Facades\Route;

use GuzzleHttp\Client;

use Taskly\User;

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
     * |-----------------------------------------------------------------
     * |    get all users
     * |    @return [type] [description]
     * |-----------------------------------------------------------------
     */
    public function index()
    {
        return fractal(
            $this->user->all(),
            new UsersTransformer()
        )->toArray();
    }

    /**
     * |------------------------------------------------------------------
     * |    get single user from slug
     * |    @param  [type] $user_slug [description]
     * |    @return [type]            [description]
     * |------------------------------------------------------------------
     */
    public function user($user_slug)
    {
    	return fractal(
            $this->user->whereSlug($user_slug)->first(),
            new UserTransformer()
        )->toArray();
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
            'username' => $request->username,
            'password' => $request->password,
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID', 1),
            'client_secret' => env('PASSPORT_CLIENT_SECRET', ''),
            'scope' => '*'
        ]);

        /**
         * adding oauth/token endpoint to Routes group
         * @var [type]
         */
        $proxy = Request::create('oauth/token', 'POST');

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
        /**
         * Validating request input
         * @var [type]
         */
        $validator = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        /**
         * check for failing request
         */
        if ($validator->fails()) {
            return response()->json([
                'error' => 'Something went wrong with your request'
            ]);
        }

        /**
         * Creating new user from request input
         * @var [type]
         */
        $user = User::create([
          'firstname' => $request->get('firstname'),
          'lastname' => $request->get('lastname'),
          'name' => $request->get('firstname') . ' ' . $request->get('lastname'),
          'slug' => strtolower($request->get('firstname')) . '-' . strtolower($request->get('lastname')),
          'email' => $request->input('email'),
          'password' => bcrypt($request->get('password'))
        ]);

        // Sign the user in
        $http = new GuzzleHttp\Client;

        // sending the requesting information to passport token endpoint
        $response = $http->post(URL::to('/oauth/token'), [
          'form_params' => [
            'grant_type' => 'password',
            'client_id' => env('PASSPORT_CLIENT_ID', 1),
            'client_secret' => env('PASSPORT_CLIENT_SECRET', ''),
            'username' => $request->input('email'),
            'password' => $request->input('password'),
            'scope' => '*'
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

    /**
     * |---------------------------------------------------------------
     * |    Creating a new user resource
     * |    @param  Request $request [description]
     * |    @return [type]           [description]
     * |---------------------------------------------------------------
     */
    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        if($request->fails()) {
            return response()->json([
                'error' => 'something went wrong creating user resource'
            ]);
        }

        try {
            $this->user->create([
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'name' => $request->get('firstname') . ' ' . $request->get('lastname'),
                'slug' => strtolower($request->get('firstname')) . '-' . strtolower($request->get('lastname')),
                'email' => $request->get('email'),
                'password' => bcrypt($request->get('password'))
            ]);
        } catch (BadMethodCallException $e) {
            return $e;
        }
    }
}
