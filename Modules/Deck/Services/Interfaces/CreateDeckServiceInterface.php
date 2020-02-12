<?php

namespace Modules\Deck\Services\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface CreateDeckService
 * @package Modules\Deck\Services\Interfaces
 */
interface CreateDeckServiceInterface
{
    /**
     * Create new deck by request.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create (Request $request): JsonResponse;
}