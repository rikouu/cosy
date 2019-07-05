<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Cosy\Auth\AuthManager as Auth;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\ThrottlesLogins;

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
     * @var Auth
     */
    protected $auth;

    /**
     * LoginController constructor.
     *
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
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
     * @param LoginRequest $request
     *
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
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
     * @param LoginRequest $request
     *
     * @return bool
     */
    protected function attemptLogin(LoginRequest $request)
    {
        return $this->auth->attempt(
            $this->credentials($request),
            $request->filled('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param LoginRequest $request
     *
     * @return array
     */
    protected function credentials(LoginRequest $request)
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
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    protected function sendLoginResponse(LoginRequest $request)
    {
        $this->clearLoginAttempts($request);
        $token = 'Bearer '.$this->auth->getToken();
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
        return $user->display_name.', 欢迎回来!';
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
