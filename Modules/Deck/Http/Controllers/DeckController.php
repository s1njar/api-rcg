<?php

namespace Modules\Deck\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Deck\Entities\Deck;
use Modules\Deck\Services\CreateDeckService;
use Throwable;

/**
 * Class DeckController
 */
class DeckController extends Controller
{
    /**
     * @var CreateDeckService
     */
    private $createDeckService;

    /**
     * DeckController constructor.
     *
     * @param CreateDeckService $createDeckService
     */
    public function __construct(CreateDeckService $createDeckService)
    {
//        $this->middleware('auth:api');

        $this->createDeckService = $createDeckService;
    }

    /**
     * Create endpoint
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            Deck::NAME_FIELD => 'required|string',
            Deck::CODE_FIELD => 'required|string',
            Deck::USER_FIELD => 'required|integer',
            Deck::CARDS_RELATION => 'required',
        ]);

        return $this->createDeckService->create($request);
    }
}
