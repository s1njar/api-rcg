<?php

namespace Modules\Generator\Services\Generator\Attributes;

use Illuminate\Database\Eloquent\Collection;
use Modules\Cards\Entities\Ability;
use Modules\Generator\Exceptions\CardGeneratorAttributeException;
use Modules\Generator\Model\CardGeneratorModel;
use Modules\Generator\Services\Generator\AttributeGeneratorInterface;

/**
 * Class AbilityGeneratorService
 */
class AbilityGeneratorService implements AttributeGeneratorInterface
{
    /**
     * Generates new attribute or uses existing if it's already set.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return mixed
     * @throws CardGeneratorAttributeException
     */
    public function execute(CardGeneratorModel $cardGeneratorModel): CardGeneratorModel
    {
        if ($cardGeneratorModel->getAbilities()) {
            return $cardGeneratorModel;
        }

        $abilities = Ability::all();

        $cardGeneratorModel->setAbilities($this->getAbilityIds($cardGeneratorModel, $abilities));

        return $cardGeneratorModel;
    }

    /**
     * Collects all ability ids.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @param Collection $abilities
     * @return array
     * @throws CardGeneratorAttributeException
     */
    private function getAbilityIds(CardGeneratorModel $cardGeneratorModel, Collection $abilities): array
    {
        $abilityIds = [];
        $sourceRarity = $cardGeneratorModel->getRarity();
        $sourceCardType = $cardGeneratorModel->getCardType();
        $abilityCount = rand(0, 2);

        $activeAbility = $this->getActiveAbility($abilities, $sourceRarity, $sourceCardType);
        $abilityIds[] = $activeAbility->getAttribute('id');

        $passiveAbilities = $this->getPassiveAbility($abilities, $sourceRarity, $sourceCardType, $abilityCount);

        foreach ($passiveAbilities as $passiveAbility) {
            $abilityIds[] = $passiveAbility->getAttribute('id');
        }

        return $abilityIds;
    }

    /**
     * Returns active ability. Throws exception if nothing were found.
     *
     * @param Collection $abilities
     * @param int $sourceRarity
     * @param int $sourceCardType
     * @return Ability
     * @throws CardGeneratorAttributeException
     */
    private function getActiveAbility(Collection $abilities, int $sourceRarity, int $sourceCardType): Ability
    {
        /** @var Collection $filtered */
        $filtered = $abilities
            ->where(
                Ability::TYPE_FIELD,
                '=',
                1
            )
            ->whereIn(
                Ability::SOURCE_RARITY_FIELD,
                [
                    0,
                    $sourceRarity
                ]
            )->whereIn(
                Ability::SOURCE_CARD_TYPE_FIELD,
                [
                    0,
                    $sourceCardType
                ]
            );

        if (!$filtered->count()) {
            throw new CardGeneratorAttributeException(
                'Seems that there are no abilites found for Card.',
                404
            );
        }

        return $filtered->random();
    }

    /**
     * Returns passive abilities if there are something requested (ability count) and found.
     *
     * @param Collection $abilities
     * @param int $sourceRarity
     * @param int $sourceCardType
     * @param int $abilityCount
     * @return Ability[]
     */
    private function getPassiveAbility(
        Collection $abilities,
        int $sourceRarity,
        int $sourceCardType,
        int $abilityCount
    ): array {

        if (!$abilityCount) {
            return [];
        }

        /** @var Collection $filtered */
        $filtered = $abilities
            ->where(
                Ability::TYPE_FIELD,
                '=',
                0
            )
            ->whereIn(
                Ability::SOURCE_RARITY_FIELD,
                [
                    0,
                    $sourceRarity
                ]
            )->whereIn(
                Ability::SOURCE_CARD_TYPE_FIELD,
                [
                    0,
                    $sourceCardType
                ]
            );

        $count = $filtered->count();

        if ($count < $abilityCount) {
            return  $filtered->random($count)->all();
        }

        return $filtered->random($abilityCount)->all();
    }
}
