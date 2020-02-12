<?php

namespace Modules\Cards\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cards\Entities\Card;
use Modules\Cards\Helper\GeneratorHelper;
use Modules\Cards\Services\CreateCardService;
use Throwable;

/**
 * Class CardsController
 */
class CardsController extends Controller
{
    /**
     * @var CreateCardService
     */
    private $createCardService;
    /**
     * @var GeneratorHelper
     */
    private $generatorHelper;

    /**
     * CardsController constructor.
     *
     * @param CreateCardService $createCardService
     * @param GeneratorHelper $generatorHelper
     */
    public function __construct(
        CreateCardService $createCardService,
        GeneratorHelper $generatorHelper
    ) {
//        $this->middleware('auth:api');

        $this->createCardService = $createCardService;
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
                Card::CATEGORY_FIELD => 'required|string',
                Card::CARD_TYPE_FIELD => 'required|string',
                Card::RARITY_TYPE_FIELD => 'required|string',
                Card::ABILITIES_RELATION => 'required'
            ]);
        } else {
            $request = $this->generatorHelper->createRequest();
        }

        return $this->createCardService->create($request);
    }
}
