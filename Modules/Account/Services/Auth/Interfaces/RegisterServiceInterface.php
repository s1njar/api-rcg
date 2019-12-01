<?php
/**
 * @copyright Copyright (c) netz98 GmbH (http://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Account\Services\Auth\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface RegisterServiceInterface
 */
interface RegisterServiceInterface
{
    /**
     * Register new user to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse;
}
