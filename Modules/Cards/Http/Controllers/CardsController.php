<?php

namespace Modules\Cards\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cards\Entities\Card;
use Modules\Cards\Services\CardBatchService;
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
    public const QUANTITY_REQUEST_FIELD = 'quantity';
    public const CUSTOM_REQUEST_FIELD = 'custom';

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
     * @var CardBatchService
     */
    private $cardBatchService;

    /**
     * CardsController constructor.
     *
     * @param CardRepositoryService $cardRepositoryService
     * @param GeneratorHelper $generatorHelper
     * @param CardGeneratorService $cardGeneratorService
     * @param CardBatchService $cardBatchService
     */
    public function __construct(
        CardRepositoryService $cardRepositoryService,
        GeneratorHelper $generatorHelper,
        CardGeneratorService $cardGeneratorService,
        CardBatchService $cardBatchService
    ) {
//        $this->middleware('auth:api');

        $this->cardRepositoryService = $cardRepositoryService;
        $this->generatorHelper = $generatorHelper;
        $this->cardGeneratorService = $cardGeneratorService;
        $this->cardBatchService = $cardBatchService;
    }

    /**
     * API create endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $cardGeneratorModel = new CardGeneratorModel();

        if ($request->has(self::CUSTOM_REQUEST_FIELD) && $request->get(self::CUSTOM_REQUEST_FIELD)) {
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
     * API createBatch endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function createBatch(Request $request): JsonResponse
    {
        $request->validate([
            self::QUANTITY_REQUEST_FIELD => 'required|integer',
            self::CUSTOM_REQUEST_FIELD => 'required|boolean',
            Card::NAME_FIELD => 'max:0|string',
            Card::CODE_FIELD => 'max:0|string',
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

        return $this->cardBatchService
            ->execute(
                $request
                    ->get(
                        self::QUANTITY_REQUEST_FIELD
                    ),
                $request
            );
    }

    /**
     * API search endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        return $this->cardRepositoryService->search();
    }

    /**
     * API searchById endpoint.
     *
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
     * API delete endpoint.
     *
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

    /**
     * API disable endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function enable(Request $request)
    {
        $request->validate([
            'ids' => 'required|array'
        ]);

        $ids = $request->get('ids');

        return $this->cardRepositoryService->enable($ids);
    }

    /**
     * API disable endpoint.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function disable(Request $request)
    {
        $request->validate([
            'ids' => 'required|array'
        ]);

        $ids = $request->get('ids');

        return $this->cardRepositoryService->disable($ids);
    }
}
