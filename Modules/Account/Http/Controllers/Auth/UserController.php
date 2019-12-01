<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\User;
use Modules\Account\Services\Auth\LoginService;
use Modules\Account\Services\Auth\RegisterService;

/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @var LoginService
     */
    private $loginService;
    /**
     * @var RegisterService
     */
    private $registerService;

    /**
     * UserController constructor.
     *
     * @param LoginService $loginService
     * @param RegisterService $registerService
     */
    public function __construct(
        LoginService $loginService,
        RegisterService $registerService
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);

        $this->loginService = $loginService;
        $this->registerService = $registerService;
    }

    /**
     * Log in to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate([
            User::USERNAME_FIELD => 'required|string',
            User::PASSWORD_FIELD => 'required|string',
        ]);

        return $this->loginService->login($request);
    }

    /**
     * Register new user to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            User::USERNAME_FIELD => ['required', 'string', 'max:255', 'unique:users'],
            User::EMAIL_FIELD => ['required', 'string', 'email', 'max:255', 'unique:users'],
            User::PASSWORD_FIELD => ['required', 'string', 'min:8'],
        ]);

        return $this->registerService->register($request);
    }

    /**
     * Logout from application.
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth('api')->logout();

        return response()->json(['status' => 'ok', 'message' => 'Successfully logged out']);
    }

    /**
     * Returns current logged in user.
     *
     * @return JsonResponse
     */
    public function current(): JsonResponse
    {
        $user = auth('api')->user();

        return response()->json($user);
    }
}
