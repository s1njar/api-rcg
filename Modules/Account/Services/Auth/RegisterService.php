<?php
/**
 * @copyright Copyright (c) netz98 GmbH (http://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Services\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Modules\Account\Entities\User;
use Modules\Account\Services\Auth\Interfaces\RegisterServiceInterface;

/**
 * Class RegisterService
 * @package Modules\Account\Services\Auth
 */
class RegisterService implements RegisterServiceInterface
{
    /**
     * @var LoginService
     */
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    /**
     * Register new user to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        $data = $request->only([
            User::USERNAME_FIELD,
            User::EMAIL_FIELD,
            User::PASSWORD_FIELD,
        ]);

        if (!$this->createUser($data)) {
            return response()->json(['status' => 'error', 'message' => 'User could not be created'], 422);
        }

        return $this->loginService->login($request);
    }

    /**
     * @param array $data
     * @return User
     */
    private function createUser(array $data): User
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
