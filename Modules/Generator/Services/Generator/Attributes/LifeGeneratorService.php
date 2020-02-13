<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Exception;
use Modules\Cards\Entities\CardType;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class LifeGeneratorService
 */
class LifeGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     * @throws Exception
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getLife()) {
            return $cardGeneratorModel;
        }

        $cardTypeId = $cardGeneratorModel->getCardType();
        /** @var CardType $cardType */
        $cardType = CardType::find($cardTypeId);

        $code = $cardType->getAttribute('code');

        $cardGeneratorModel->setLife($this->getLife($code));

        return $cardGeneratorModel;
    }

    /**
     * Throws Exception if no card_type code will match.
     *
     * @param string $code
     * @return int
     * @throws Exception
     */
    private function getLife(string $code): int
    {
        switch ($code) {
            case 'light_melee_infantry':
                $life = rand(60, 70);
                break;
            case 'heavy_Melee_infantry':
                $life = rand(70, 80);
                break;
            case 'light_distance_infantry':
                $life = rand(40, 50);
                break;
            case 'heavy_distance_infantry':
                $life = rand(30, 40);
                break;
            case 'cavalry':
                $life = rand(50, 60);
                break;
            default:
                throw new Exception('Fatal: no code matching of card_types', 404);
                break;
        }

        return $life;
    }
}
