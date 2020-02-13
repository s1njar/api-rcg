<?php

namespace Modules\Cards\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cards\Entities\Card;
use Modules\Cards\Services\CardRepositoryService;
use Modules\Generator\Helper\GeneratorHelper;
use Throwable;

/**
 * Class CardsController
 */
class CardsController extends Controller
{
    /**
     * @var CardRepositoryService
     */
    private $cardRepositoryService;
    /**
     * @var GeneratorHelper
     */
    private $generatorHelper;

    /**
     * CardsController constructor.
     *
     * @param CardRepositoryService $cardRepositoryService
     * @param GeneratorHelper $generatorHelper
     */
    public function __construct(
        CardRepositoryService $cardRepositoryService,
        GeneratorHelper $generatorHelper
    ) {
//        $this->middleware('auth:api');

        $this->cardRepositoryService = $cardRepositoryService;
        $this->generatorHelper = $generatorHelper;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        if ($request->has(Card::CODE_FIELD)) {
            $request->validate([
                Card::NAME_FIELD => 'required|string',
                Card::CODE_FIELD => 'required|string',
                Card::LIFE_FIELD => 'required|integer',
                Card::MORAL_FIELD => 'required|integer',
                Card::STRENGTH_FIELD => 'required|integer',
                Card::PICTURE_FIELD => 'required|url',
                Card::CATEGORY_FIELD => 'required|integer',
                Card::CARD_TYPE_FIELD => 'required|integer',
                Card::RARITY_TYPE_FIELD => 'required|integer',
                Card::ABILITIES_RELATION => 'required'
            ]);
        } else {
            $request = $this->generatorHelper->createRequest();
        }

        return $this->cardRepositoryService->create($request);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->cardRepositoryService->search();
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

        return $this->cardRepositoryService->searchById($id);
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

        return $this->cardRepositoryService->delete($id);
    }
}
