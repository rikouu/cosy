<?php

namespace App\Cosy\Auth;

use App\Models\User;
use Illuminate\Auth\AuthManager as LaravelAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Manager;

/**
 * Class AuthManager.
 */
class AuthManager
{
    /**
     * @var JWTAuth
     */
    protected $jwtAuth;

    /**
     * @var LaravelAuth
     */
    protected $auth;

    /**
     * AuthController constructor.
     *
     * @param JWTAuth     $jwtAuth
     * @param LaravelAuth $auth
     */
    public function __construct(JWTAuth $jwtAuth, LaravelAuth $auth)
    {
        $this->jwtAuth = $jwtAuth;
        $this->auth = $auth;
    }

    /**
     * @param Request $request
     */
    public function logout(Request $request)
    {
        // Web
        $this->auth->logout();
        $request->session()->invalidate();

        // Api
        if ($this->jwtAuth->setRequest($request)->getToken()) {
            $this->jwtAuth->invalidate(false);
            $this->jwtAuth->unsetToken();
        }
    }

    /**
     * @param User $user
     */
    public function login(User $user)
    {
        $this->auth->login($user);

        $this->jwtAuth->login($user);
    }

    /**
     * @return Manager
     */
    public function manager()
    {
        return $this->jwtAuth->manager();
    }

    /**
     * @throws TokenInvalidException
     *
     * @return string
     */
    public function tokenRefresh()
    {
        try {
            return $this->jwtAuth->refresh();
        } catch (TokenInvalidException $e) {
            throw $e;
        }
    }

    /**
     * @param Request $request
     */
    public function checkForToken(Request $request)
    {
        if (!$this->jwtAuth->parser()->setRequest($request)->hasToken()) {
            throw new UnauthorizedHttpException('jwt-auth', 'Token not provided');
        }
    }

    public function check()
    {
        return $this->jwtAuth->parseToken()->authenticate();
    }

    /**
     * Log the given user ID into the application without sessions or cookies.
     *
     * @param mixed $id
     *
     * @return bool
     */
    public function onceUsingId($id)
    {
        return Auth::guard('jwt')->onceUsingId($id);
    }

    /**
     * @param array $credentials
     * @param bool  $remember
     *
     * @return bool
     */
    public function attempt(array $credentials, $remember = false)
    {
        $token = $this->jwtAuth->attempt(
            $credentials
        );

        $user = $this->auth->attempt(
            $credentials,
            $remember
        );

        if (!empty($token) || !empty($user)) {
            session()->regenerate();
            $this->jwtAuth->setToken($token);

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->jwtAuth->getToken()->get();
    }

    /**
     * @return User|null
     */
    public function user(): ?User
    {
        return $this->auth->user();
    }
}
