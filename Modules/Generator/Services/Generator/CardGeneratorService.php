<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Generator\Services\Generator;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\Attributes\CardTypeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\CategoryGeneratorService;
use Modules\Generator\Services\Generator\Attributes\LifeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\NameGeneratorService;
use Modules\Generator\Services\Generator\Attributes\PictureGeneratorService;
use Modules\Generator\Services\Generator\Attributes\RarityGeneratorService;

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
     * @var LifeGeneratorService
     */
    private $lifeGeneratorService;

    /**
     * CardGeneratorService constructor.
     *
     * @param CategoryGeneratorService $categoryGeneratorService
     * @param NameGeneratorService $nameGeneratorService
     * @param PictureGeneratorService $pictureGeneratorService
     * @param RarityGeneratorService $rarityGeneratorService
     * @param CardTypeGeneratorService $cardTypeGeneratorService
     * @param LifeGeneratorService $lifeGeneratorService
     */
    public function __construct(
        CategoryGeneratorService $categoryGeneratorService,
        NameGeneratorService $nameGeneratorService,
        PictureGeneratorService $pictureGeneratorService,
        RarityGeneratorService $rarityGeneratorService,
        CardTypeGeneratorService $cardTypeGeneratorService,
        LifeGeneratorService $lifeGeneratorService
    ) {
        $this->categoryGeneratorService = $categoryGeneratorService;
        $this->nameGeneratorService = $nameGeneratorService;
        $this->pictureGeneratorService = $pictureGeneratorService;
        $this->rarityGeneratorService = $rarityGeneratorService;
        $this->cardTypeGeneratorService = $cardTypeGeneratorService;
        $this->lifeGeneratorService = $lifeGeneratorService;
    }

    /**
     * Responsible to create attributes in correct queue.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return CardGeneratorModel
     * @throws \Exception
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        $this->categoryGeneratorService->execute($cardGeneratorModel);
        $this->nameGeneratorService->execute($cardGeneratorModel);
        $this->pictureGeneratorService->execute($cardGeneratorModel);
        $this->rarityGeneratorService->execute($cardGeneratorModel);
        $this->cardTypeGeneratorService->execute($cardGeneratorModel);
        $this->lifeGeneratorService->execute($cardGeneratorModel);

        return $cardGeneratorModel;
    }
}