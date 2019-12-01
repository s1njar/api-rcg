<?php
/**
 * @copyright Copyright (c) netz98 GmbH (http://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Services\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Account\Entities\User;
use Modules\Account\Services\Auth\Interfaces\LoginServiceInterface;

/**
 * Class LoginService
 */
class LoginService implements LoginServiceInterface
{
    /**
     * Log in to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $data = $request->only([
            User::USERNAME_FIELD,
            User::PASSWORD_FIELD
        ]);

        if (!$token = auth('api')->attempt($data)) {
            return response()->json(['status' => 'error', 'message' => 'User could not be logged in'], 401);
        }

        return $this->respond($token);
    }

    /**
     * @param string $token
     * @return JsonResponse
     */
    private function respond(string $token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'user' => auth('api')->user(),
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
