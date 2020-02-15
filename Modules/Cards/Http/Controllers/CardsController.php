<?php

namespace Modules\Cards\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cards\Entities\Card;
use Modules\Cards\Services\CardRepositoryService;
use Modules\Generator\Helper\GeneratorHelper;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\CardGeneratorService;
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
     * @var CardGeneratorService
     */
    private $cardGeneratorService;

    /**
     * CardsController constructor.
     *
     * @param CardRepositoryService $cardRepositoryService
     * @param GeneratorHelper $generatorHelper
     * @param CardGeneratorService $cardGeneratorService
     */
    public function __construct(
        CardRepositoryService $cardRepositoryService,
        GeneratorHelper $generatorHelper,
        CardGeneratorService $cardGeneratorService
    ) {
//        $this->middleware('auth:api');

        $this->cardRepositoryService = $cardRepositoryService;
        $this->generatorHelper = $generatorHelper;
        $this->cardGeneratorService = $cardGeneratorService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $cardGeneratorModel = new CardGeneratorModel();
        $this->cardGeneratorService->execute($cardGeneratorModel);

        return response()->json(['card' => $this->generatorHelper->getArray($cardGeneratorModel)]);
        die();
        if ($request->has('custom') && $request->get('custom')) {
            $request->validate([
                Card::NAME_FIELD => 'string',
                Card::CODE_FIELD => 'string',
                Card::LIFE_FIELD => 'integer',
                Card::MORAL_FIELD => 'integer',
                Card::STRENGTH_FIELD => 'integer',
                Card::SPEED_FIELD => 'integer',
                Card::RANGE_FIELD => 'integer',
                Card::IMAGE_FIELD => 'url',
                Card::CATEGORY_FIELD => 'integer',
                Card::CARD_TYPE_FIELD => 'integer',
                Card::RARITY_TYPE_FIELD => 'integer',
                Card::ABILITIES_RELATION => 'array'
            ]);

            $this->generatorHelper->fillModelWithRequest($cardGeneratorModel, $request);
        }

        $this->cardGeneratorService->execute($cardGeneratorModel);
        return $this->cardRepositoryService
            ->create(
                $this->generatorHelper
                    ->getRequest(
                        $cardGeneratorModel
                    )
            );
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
