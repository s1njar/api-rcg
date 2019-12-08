<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Http\Controllers\User\Password;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PasswordController
 */
class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    /**
     * @param Request $request
     * @return Response
     */
    public function execute(Request $request): Response
    {
        return $this->reset($request);
    }

    /**
     * @param $user
     * @param $password
     */
    protected function resetPassword($user, $password)
    {
        $this->setUserPassword($user, $password);
        $user->save();

        event(new PasswordReset($user));
    }

    /**
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'Password reset successfull'
            ]
        );
    }

    /**
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response()->json(
            [
                'status' => 'error',
                'message' => 'Token is invalid.'
            ],
            401
        );
    }
}
