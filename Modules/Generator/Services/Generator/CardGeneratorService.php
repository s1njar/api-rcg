<?php
/**
 * @copyright Copyright (c) netz98 GmbH (https://www.netz98.de)
 *
 * @see PROJECT_LICENSE.txt
 */

namespace Modules\Generator\Services\Generator;

use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\Attributes\AbilityGeneratorService;
use Modules\Generator\Services\Generator\Attributes\CardTypeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\CategoryGeneratorService;
use Modules\Generator\Services\Generator\Attributes\CodeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\NameGeneratorService;
use Modules\Generator\Services\Generator\Attributes\ImageGeneratorService;
use Modules\Generator\Services\Generator\Attributes\RangeGeneratorService;
use Modules\Generator\Services\Generator\Attributes\RarityGeneratorService;
use Modules\Generator\Services\Generator\Attributes\SpeedGeneratorService;
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
     * @var ImageGeneratorService
     */
    private $imageGeneratorService;
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
     * @var SpeedGeneratorService
     */
    private $speedGeneratorService;
    /**
     * @var RangeGeneratorService
     */
    private $rangeGeneratorService;
    /**
     * @var AbilityGeneratorService
     */
    private $abilityGeneratorService;
    /**
     * @var CodeGeneratorService
     */
    private $codeGeneratorService;

    /**
     * CardGeneratorService constructor.
     *
     * @param CategoryGeneratorService $categoryGeneratorService
     * @param NameGeneratorService $nameGeneratorService
     * @param ImageGeneratorService $imageGeneratorService
     * @param RarityGeneratorService $rarityGeneratorService
     * @param CardTypeGeneratorService $cardTypeGeneratorService
     * @param TotalPowerGeneratorService $totalPowerGeneratorService
     * @param SpeedGeneratorService $speedGeneratorService
     * @param RangeGeneratorService $rangeGeneratorService
     * @param AbilityGeneratorService $abilityGeneratorService
     * @param CodeGeneratorService $codeGeneratorService
     */
    public function __construct(
        CategoryGeneratorService $categoryGeneratorService,
        NameGeneratorService $nameGeneratorService,
        ImageGeneratorService $imageGeneratorService,
        RarityGeneratorService $rarityGeneratorService,
        CardTypeGeneratorService $cardTypeGeneratorService,
        TotalPowerGeneratorService $totalPowerGeneratorService,
        SpeedGeneratorService $speedGeneratorService,
        RangeGeneratorService $rangeGeneratorService,
        AbilityGeneratorService $abilityGeneratorService,
        CodeGeneratorService $codeGeneratorService
    ) {
        $this->categoryGeneratorService = $categoryGeneratorService;
        $this->nameGeneratorService = $nameGeneratorService;
        $this->imageGeneratorService = $imageGeneratorService;
        $this->rarityGeneratorService = $rarityGeneratorService;
        $this->cardTypeGeneratorService = $cardTypeGeneratorService;
        $this->totalPowerGeneratorService = $totalPowerGeneratorService;
        $this->speedGeneratorService = $speedGeneratorService;
        $this->rangeGeneratorService = $rangeGeneratorService;
        $this->abilityGeneratorService = $abilityGeneratorService;
        $this->codeGeneratorService = $codeGeneratorService;
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
        $this->imageGeneratorService->execute($cardGeneratorModel);
        $this->rarityGeneratorService->execute($cardGeneratorModel);
        $this->cardTypeGeneratorService->execute($cardGeneratorModel);
        $this->totalPowerGeneratorService->execute($cardGeneratorModel);
        $this->speedGeneratorService->execute($cardGeneratorModel);
        $this->rangeGeneratorService->execute($cardGeneratorModel);
        $this->abilityGeneratorService->execute($cardGeneratorModel);
        $this->codeGeneratorService->execute($cardGeneratorModel);

        return $cardGeneratorModel;
    }
}
