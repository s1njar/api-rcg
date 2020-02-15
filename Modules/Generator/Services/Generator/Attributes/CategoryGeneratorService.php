<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Cards\Entities\Category;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class CategoryGeneratorService
 */
class CategoryGeneratorService implements AttributeGeneratorInterface
{

    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getCategory()) {
            return $cardGeneratorModel;
        }

        $categories = Category::all();

        /** @var Category $category */
        $category = $categories->random();

        $cardGeneratorModel->setCategory($category->getAttributeValue('id'));

        return $cardGeneratorModel;
    }
}
