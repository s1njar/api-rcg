<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Generator\Services\Generator;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\Attributes\CategoryGeneratorService;
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
     * CardGeneratorService constructor.
     *
     * @param CategoryGeneratorService $categoryGeneratorService
     * @param NameGeneratorService $nameGeneratorService
     * @param PictureGeneratorService $pictureGeneratorService
     * @param RarityGeneratorService $rarityGeneratorService
     */
    public function __construct(
        CategoryGeneratorService $categoryGeneratorService,
        NameGeneratorService $nameGeneratorService,
        PictureGeneratorService $pictureGeneratorService,
        RarityGeneratorService $rarityGeneratorService
    ) {
        $this->categoryGeneratorService = $categoryGeneratorService;
        $this->nameGeneratorService = $nameGeneratorService;
        $this->pictureGeneratorService = $pictureGeneratorService;
        $this->rarityGeneratorService = $rarityGeneratorService;
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
        $this->nameGeneratorService->execute($cardGeneratorModel);
        $this->pictureGeneratorService->execute($cardGeneratorModel);
        $this->rarityGeneratorService->execute($cardGeneratorModel);

        return $cardGeneratorModel;
    }
}