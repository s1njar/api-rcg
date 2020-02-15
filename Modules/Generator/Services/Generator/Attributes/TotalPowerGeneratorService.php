<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Modules\Cards\Entities\Rarity;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class TotalPowerGeneratorService
 */
class TotalPowerGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return CardGeneratorModel
     * @throws CardGeneratorAttributeException
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        $rarityId = $cardGeneratorModel->getRarity();
        $attributes = $this
            ->getBalancedAttributes(
                $this->getRarityTotal(
                    $rarityId
                ),
                $cardGeneratorModel->getLife(),
                $cardGeneratorModel->getMoral(),
                $cardGeneratorModel->getStrength() * 10
            );

        $cardGeneratorModel->setLife(intval($attributes[0]));
        $cardGeneratorModel->setMoral(intval($attributes[1]));
        $cardGeneratorModel->setStrength((int) round($attributes[2] / 10));

        return $cardGeneratorModel;
    }

    /**
     * Takes predefined attributes if exist and calculates balanced average of attributes by total.
     *
     * @param int $rarityTotal
     * @param int $life
     * @param int $moral
     * @param int $strength
     * @return array
     * @throws CardGeneratorAttributeException
     */
    private function getBalancedAttributes(
        int $rarityTotal,
        int $life = null,
        int $moral = null,
        int $strength = null
    ): array {
        $break = 0;

        while (true) {
            if ($break > 500) {
                throw new CardGeneratorAttributeException(
                    'Seems that calculation went wrong. Try to use less predefined numbers.',
                    500
                );
            }

            $a = $life ?: rand(30, 100);
            $b = $moral ?: rand(30, 100);
            $c = $strength ?: rand(30, 100);

            if (($a + $b + $c) == $rarityTotal) {
                return [$a, $b, $c];
            }

            if (($a + $b + $c) < ($rarityTotal + 5) && ($a + $b + $c) > ($rarityTotal - 5)) {
                $average = ($rarityTotal - ($a + $b + $c)) / 3;

                $a += $average;
                $b += $average;
                $c += $average;

                if ($a <= 100 && $b <= 100 && $c <= 100) {
                    return [$a, $b, $c];
                }
            }

            $break++;
        }

        return [];
    }

    /**
     * Returns total power by rarity level.
     * Exception should only be thrown if rarity codes where changed in database seeder:
     * \Modules\Cards\Database\Seeders\RaritiesTableSeeder
     *
     * @param int $rarityId
     * @return int
     * @throws CardGeneratorAttributeException
     */
    private function getRarityTotal(int $rarityId): int
    {
        /** @var Rarity $rarity */
        $rarity = Rarity::find($rarityId);

        switch ($rarity->getAttribute('code')) {
            case 'bronze':
                $total = 175;
                break;
            case 'silver':
                $total = 200;
                break;
            case 'gold':
                $total = 225;
                break;
            case 'legend':
                $total = 250;
                break;
            default:
                throw new CardGeneratorAttributeException(
                    'Fatal: no code matching of rarity',
                    404
                );
                break;
        }

        return $total;
    }
}
