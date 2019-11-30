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
 * Interface LoginServiceInterface
 * @package Modules\Account\Services\Auth\Interfaces
 */
interface LoginServiceInterface
{
    /**
     * Log in to application.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse;
}