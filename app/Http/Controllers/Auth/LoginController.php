<?php

namespace App\Http\Controllers\Auth;

use App\Cosy\Auth\AuthManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use ThrottlesLogins;

    /**
     * @var AuthManager
     */
    protected $auth;

    /**
     * LoginController constructor.
     *
     * @param AuthManager $auth
     */
    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Log the user out of the application.
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function logout(LoginRequest $request)
    {
        $this->auth->logout($request);

        return response()->json([
            'result'  => true,
            'message' => '',
        ]);
    }

    /**
     * Handle a login request to the application.
     *
     * @param Request $request
     *
     * @return JsonResponse
     * @throws ValidationException
     *
     */
    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        $this->incrementLoginAttempts($request);

        throw ValidationException::withMessages([
            'username' => [trans('auth.failed')],
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->auth->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     *
     * @return array
     */
    protected function credentials(Request $request)
    {
        $username = $request->only($this->username());
        $type = filter_var($username, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        return [
            $type      => $username,
            'password' => $request->input('password'),
        ];
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        $token = 'Bearer ' . $this->auth->getToken();
        $user = $this->auth->user();
        $welcome = $this->generateWelcome($user);

        return response()
            ->json([
                'data' => [
                    'token'   => $token,
                    'welcome' => $welcome,
                    'user'    => $user,
                ],
            ])
            ->header('authorization', $token);
    }

    /**
     * @param User $user
     *
     * @return string
     */
    protected function generateWelcome(User $user)
    {
        return $user->display_name . ', 欢迎回来!';
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    protected function username()
    {
        return 'username';
    }

}
