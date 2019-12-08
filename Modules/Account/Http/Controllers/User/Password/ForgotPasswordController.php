<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Http\Controllers\User\Password;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Response;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function execute(Request $request): Response
    {
        return $this->sendResetLinkEmail($request);
    }

    /**
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response): Response
    {
        return response()->json(
            [
                'status' => 'ok',
                'message' => 'Password reset email sent'
            ]
        );
    }

    /**
     * @param Request $request
     * @param $response
     * @return JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response): Response
    {
        return response()->json(
            [
                'status' => 'error',
                'message' => 'Email could not be sent to this email address'
            ],
            502
        );
    }
}
