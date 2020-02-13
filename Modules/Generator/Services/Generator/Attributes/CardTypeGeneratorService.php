<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Cards\Entities\CardType;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class CardTypeGeneratorService
 */
class CardTypeGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getCardType()) {
            return $cardGeneratorModel;
        }

        $cardTypes = CardType::all();
        /** @var CardType $cardType */
        $cardType = $cardTypes->random();

        $cardGeneratorModel->setCardType($cardType->getAttribute('id'));

        return $cardGeneratorModel;
    }
}
