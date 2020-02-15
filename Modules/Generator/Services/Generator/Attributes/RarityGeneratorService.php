<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Cards\Entities\Rarity;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class RarityGeneratorService
 */
class RarityGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getRarity()) {
            return $cardGeneratorModel;
        }

        $rarities = Rarity::all();

        /** @var Rarity $rarity */
        $rarity = $rarities->random();

        $cardGeneratorModel->setRarity($rarity->getAttribute('id'));

        return $cardGeneratorModel;
    }
}
