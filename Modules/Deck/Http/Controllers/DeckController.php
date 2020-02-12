<?php

namespace Modules\Deck\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Deck\Entities\Deck;
use Modules\Deck\Services\DeckRepositoryService;
use Throwable;

/**
 * Class DeckController
 */
class DeckController extends Controller
{
    /**
     * @var DeckRepositoryService
     */
    private $deckRepositoryService;

    /**
     * DeckController constructor.
     *
     * @param DeckRepositoryService $deckRepositoryService
     */
    public function __construct(DeckRepositoryService $deckRepositoryService)
    {
//        $this->middleware('auth:api');

        $this->deckRepositoryService = $deckRepositoryService;
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

        return $this->deckRepositoryService->create($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->deckRepositoryService->search();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function searchById(Request $request): JsonResponse
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $id = $request->get('id');

        return $this->deckRepositoryService->searchById($id);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $id = $request->get('id');

        return $this->deckRepositoryService->delete($id);
    }
}
