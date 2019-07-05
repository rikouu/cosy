<?php

namespace App\Http\Controllers\Auth;

use App\Cosy\Auth\AuthManager as Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * RegisterController constructor.
     *
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->all());

        $this->auth->login($user);

        return $this->registered($request, $user);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return mixed
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name'         => $data['name'],
            'display_name' => $data['name'],
            'email'        => $data['email'],
            'avatar'       => getAvatar($data['email']),
            'password'     => Hash::make($data['password']),
        ]);

        return $user;
    }

    /**
     * The user has been registered.
     *
     * @param RegisterRequest $request
     * @param mixed   $user
     *
     * @return JsonResponse
     */
    protected function registered(RegisterRequest $request, $user)
    {
        $token = $this->auth->getToken();

        return response()
            ->json([
                'user'  => $user,
                'token' => $token,
            ])
            ->header('authorization', $token);
    }
}
