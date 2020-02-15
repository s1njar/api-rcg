<?php

namespace Modules\Generator\Helper;

use Illuminate\Http\Request;
use Modules\Cards\Entities\Card;
use Modules\Generator\Model\CardGeneratorModel;

/**
 * Class GeneratorHelper
 */
class GeneratorHelper
{
    /**
     * Takes data and combines it in request object.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return Request
     */
    public function getRequest(CardGeneratorModel $cardGeneratorModel): Request
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(
            [
                Card::NAME_FIELD => $cardGeneratorModel->getName(),
                Card::CODE_FIELD => $cardGeneratorModel->getCode(),
                Card::LIFE_FIELD => $cardGeneratorModel->getLife(),
                Card::MORAL_FIELD => $cardGeneratorModel->getMoral(),
                Card::ABILITIES_RELATION => $cardGeneratorModel->getAbilities(),
                Card::STRENGTH_FIELD => $cardGeneratorModel->getStrength(),
                Card::SPEED_FIELD => $cardGeneratorModel->getSpeed(),
                Card::RANGE_FIELD => $cardGeneratorModel->getRange(),
                Card::CATEGORY_FIELD => $cardGeneratorModel->getCategory(),
                Card::IMAGE_FIELD => $cardGeneratorModel->getImage(),
                Card::CARD_TYPE_FIELD => $cardGeneratorModel->getCardType(),
                Card::RARITY_TYPE_FIELD => $cardGeneratorModel->getRarity(),
            ]
        );

        return $request;
    }

    /**
     * Takes data and combines it in array.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @return array
     */
    public function getArray(CardGeneratorModel $cardGeneratorModel): array
    {
        return [
            Card::NAME_FIELD => $cardGeneratorModel->getName(),
            Card::CODE_FIELD => $cardGeneratorModel->getCode(),
            Card::LIFE_FIELD => $cardGeneratorModel->getLife(),
            Card::MORAL_FIELD => $cardGeneratorModel->getMoral(),
            Card::ABILITIES_RELATION => $cardGeneratorModel->getAbilities(),
            Card::STRENGTH_FIELD => $cardGeneratorModel->getStrength(),
            Card::SPEED_FIELD => $cardGeneratorModel->getSpeed(),
            Card::RANGE_FIELD => $cardGeneratorModel->getRange(),
            Card::CATEGORY_FIELD => $cardGeneratorModel->getCategory(),
            Card::IMAGE_FIELD => $cardGeneratorModel->getImage(),
            Card::CARD_TYPE_FIELD => $cardGeneratorModel->getCardType(),
            Card::RARITY_TYPE_FIELD => $cardGeneratorModel->getRarity(),
        ];
    }

    public function getBeautifiedCard(int $id)
    {
        /** @var Card $card */
        $card = Card::find($id);

        $card->setAttribute('card_type_id', $card->cardType()->get()->all());
        $card->setAttribute('rarity_id', $card->rarity()->get()->all());
        $card->setAttribute('category_id', $card->category()->get()->all());
        $card->setAttribute('abilities', $card->abilities()->get()->all());

        return $card;
    }

    /**
     * Takes request and fills cardGeneratorModel with passed values.
     *
     * @param CardGeneratorModel $cardGeneratorModel
     * @param Request $request
     * @return CardGeneratorModel
     */
    public function fillModelWithRequest(CardGeneratorModel $cardGeneratorModel, Request $request): CardGeneratorModel
    {
        if ($request->get(Card::NAME_FIELD)) {
            $cardGeneratorModel->setName($request->get(Card::NAME_FIELD));
        }
        if ($request->get(Card::CODE_FIELD)) {
            $cardGeneratorModel->setCode($request->get(Card::CODE_FIELD));
        }
        if ($request->get(Card::LIFE_FIELD)) {
            $cardGeneratorModel->setLife($request->get(Card::LIFE_FIELD));
        }
        if ($request->get(Card::MORAL_FIELD)) {
            $cardGeneratorModel->setMoral($request->get(Card::MORAL_FIELD));
        }
        if ($request->get(Card::ABILITIES_RELATION)) {
            $cardGeneratorModel->setAbilities($request->get(Card::ABILITIES_RELATION));
        }
        if ($request->get(Card::STRENGTH_FIELD)) {
            $cardGeneratorModel->setStrength($request->get(Card::STRENGTH_FIELD));
        }
        if ($request->get(Card::SPEED_FIELD)) {
            $cardGeneratorModel->setSpeed($request->get(Card::SPEED_FIELD));
        }
        if ($request->get(Card::RANGE_FIELD)) {
            $cardGeneratorModel->setRange($request->get(Card::RANGE_FIELD));
        }
        if ($request->get(Card::CATEGORY_FIELD)) {
            $cardGeneratorModel->setCategory($request->get(Card::CATEGORY_FIELD));
        }
        if ($request->get(Card::IMAGE_FIELD)) {
            $cardGeneratorModel->setImage($request->get(Card::IMAGE_FIELD));
        }
        if ($request->get(Card::CARD_TYPE_FIELD)) {
            $cardGeneratorModel->setCardType($request->get(Card::CARD_TYPE_FIELD));
        }
        if ($request->get(Card::RARITY_TYPE_FIELD)) {
            $cardGeneratorModel->setRarity($request->get(Card::RARITY_TYPE_FIELD));
        }

        return $cardGeneratorModel;
    }
}
