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

        $categoryId = $cardGeneratorModel->getCategory();

        $imagePath = 'app/images/cards/' . $categoryId . '/test.jpg';
        $cardGeneratorModel->setImage($imagePath);

        return $cardGeneratorModel;
    }
}
