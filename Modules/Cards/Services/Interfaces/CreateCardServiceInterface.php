<?php

namespace Modules\Cards\Services\Interfaces;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Interface CreateCardServiceInterface
 */
interface CreateCardServiceInterface
{
    /**
     * Creates new card.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse;
}