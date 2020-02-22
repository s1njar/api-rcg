<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class ImageGeneratorService
 * @package Modules\Generator\Services\Generator\Attributes
 */
class ImageGeneratorService implements AttributeGeneratorInterface
{
    public const CARD_TYPES_IMAGE_PATH = 'app/images/cards/card_types/';
    public const RARITIES_IMAGE_PATH = '/rarities/';

    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getImage()) {
            return $cardGeneratorModel;
        }

        $cardTypeId = $cardGeneratorModel->getCardType();
        $rarityId = $cardGeneratorModel->getRarity();

        $imagePath = self::CARD_TYPES_IMAGE_PATH . $cardTypeId . self::RARITIES_IMAGE_PATH . $rarityId . '/image.png';

        $cardGeneratorModel->setImage($imagePath);

        return $cardGeneratorModel;
    }
}
