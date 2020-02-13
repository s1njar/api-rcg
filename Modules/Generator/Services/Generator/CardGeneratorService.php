<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Generator\Services\Generator;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\Attributes\CategoryGeneratorService;

/**
 * Class CardGeneratorService
 */
class CardGeneratorService
{
    /**
     * @var CategoryGeneratorService
     */
    private $categoryGeneratorService;

    /**
     * CardGeneratorService constructor.
     *
     * @param CategoryGeneratorService $categoryGeneratorService
     */
    public function __construct(
        CategoryGeneratorService $categoryGeneratorService
    ) {
        $this->categoryGeneratorService = $categoryGeneratorService;
    }

    /**
     * Responsible to create attributes in correct queue.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return CardGeneratorModel
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        $this->categoryGeneratorService->execute($cardGeneratorModel);

        return $cardGeneratorModel;
    }
}