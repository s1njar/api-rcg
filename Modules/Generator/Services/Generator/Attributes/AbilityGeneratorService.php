<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

class AbilityGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getAbilities()) {
            return $cardGeneratorModel;
        }

        return $cardGeneratorModel;
    }
}
