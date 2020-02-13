<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Generator\Services\Generator;

use Exception;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\Attributes\CardTypeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\CategoryGeneratorService;
use Modules\Generator\Services\Generator\Attributes\NameGeneratorService;
use Modules\Generator\Services\Generator\Attributes\PictureGeneratorService;
use Modules\Generator\Services\Generator\Attributes\RarityGeneratorService;
use Modules\Generator\Services\Generator\Attributes\TotalPowerGeneratorService;

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
     * @var NameGeneratorService
     */
    private $nameGeneratorService;
    /**
     * @var PictureGeneratorService
     */
    private $pictureGeneratorService;
    /**
     * @var RarityGeneratorService
     */
    private $rarityGeneratorService;
    /**
     * @var CardTypeGeneratorService
     */
    private $cardTypeGeneratorService;
    /**
     * @var TotalPowerGeneratorService
     */
    private $totalPowerGeneratorService;

    /**
     * CardGeneratorService constructor.
     *
     * @param CategoryGeneratorService $categoryGeneratorService
     * @param NameGeneratorService $nameGeneratorService
     * @param PictureGeneratorService $pictureGeneratorService
     * @param RarityGeneratorService $rarityGeneratorService
     * @param CardTypeGeneratorService $cardTypeGeneratorService
     * @param TotalPowerGeneratorService $totalPowerGeneratorService
     */
    public function __construct(
        CategoryGeneratorService $categoryGeneratorService,
        NameGeneratorService $nameGeneratorService,
        PictureGeneratorService $pictureGeneratorService,
        RarityGeneratorService $rarityGeneratorService,
        CardTypeGeneratorService $cardTypeGeneratorService,
        TotalPowerGeneratorService $totalPowerGeneratorService
    ) {
        $this->categoryGeneratorService = $categoryGeneratorService;
        $this->nameGeneratorService = $nameGeneratorService;
        $this->pictureGeneratorService = $pictureGeneratorService;
        $this->rarityGeneratorService = $rarityGeneratorService;
        $this->cardTypeGeneratorService = $cardTypeGeneratorService;
        $this->totalPowerGeneratorService = $totalPowerGeneratorService;
    }

    /**
     * Responsible to create attributes in correct queue.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return CardGeneratorModel
     * @throws CardGeneratorAttributeException
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        $this->categoryGeneratorService->execute($cardGeneratorModel);
        $this->nameGeneratorService->execute($cardGeneratorModel);
        $this->pictureGeneratorService->execute($cardGeneratorModel);
        $this->rarityGeneratorService->execute($cardGeneratorModel);
        $this->cardTypeGeneratorService->execute($cardGeneratorModel);
        $this->totalPowerGeneratorService->execute($cardGeneratorModel);

        return $cardGeneratorModel;
    }
}