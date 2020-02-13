<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class PictureGeneratorService
 * @package Modules\Generator\Services\Generator\Attributes
 */
class PictureGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getPicture()) {
            return $cardGeneratorModel;
        }

        $categoryId = $cardGeneratorModel->getCategory();

        $picturePath = storage_path('app/images/cards/' . $categoryId . '/test.jpg');
        $cardGeneratorModel->setPicture($picturePath);

        return $cardGeneratorModel;
    }
}
