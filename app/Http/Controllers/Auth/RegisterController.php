<?php

namespace App\Http\Controllers\Auth;

use App\Cosy\Auth\AuthManager;
use App\Http\Controllers\Controller;
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
     * @var AuthManager
     */
    protected $auth;

    /**
     * RegisterController constructor.
     *
     * @param AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
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
     * @param Request $request
     * @param mixed   $user
     *
     * @return JsonResponse
     */
    protected function registered(Request $request, $user)
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
