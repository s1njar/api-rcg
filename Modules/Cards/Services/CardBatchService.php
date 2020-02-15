<?php

namespace Modules\Cards\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cards\Http\Controllers\CardsController;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Helper\GeneratorHelper;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\CardGeneratorService;
use Throwable;

/**
 * Class CardBatchService
 */
class CardBatchService
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
     * CardBatchService constructor.
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
        $this->cardRepositoryService = $cardRepositoryService;
        $this->generatorHelper = $generatorHelper;
        $this->cardGeneratorService = $cardGeneratorService;
    }

    /**
     * Loops by quantity and calls create method.
     *
     * @param int $quantity
     * @param Request $request
     * @return JsonResponse
     * @throws CardGeneratorAttributeException
     * @throws Throwable
     */
    public function execute(int $quantity, Request $request = null): JsonResponse
    {
        $cards = [];
        $break = 0;

        while ($break < $quantity) {
            $cards[] = $this->createCard($request);
            $break++;
        }

        return $this->getResponse($cards);
    }

    /**
     * Creates new card with custom or without custom data.
     *
     * @param Request $request
     * @return mixed
     * @throws CardGeneratorAttributeException
     * @throws Throwable
     */
    private function createCard($request)
    {
        $cardGeneratorModel = new CardGeneratorModel();

        if ($request !== null && $request->get(CardsController::CUSTOM_REQUEST_FIELD)) {
            $this->generatorHelper->fillModelWithRequest($cardGeneratorModel, $request);
        }

        $this->cardGeneratorService->execute($cardGeneratorModel);

        $response = $this->cardRepositoryService
            ->create(
                $this->generatorHelper
                    ->getRequest(
                        $cardGeneratorModel
                    )
            );

        return $response->getData()->card;
    }

    /**
     * Creates response with created cards.
     *
     * @param array $cards
     * @return JsonResponse
     */
    private function getResponse(array $cards): JsonResponse
    {
        return response()->json(
            [
                'status' => 'ok',
                'cards' => $cards
            ],
            200
        );
    }
}
