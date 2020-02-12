<?php

namespace Modules\Cards\Helper;

use Illuminate\Http\Request;
use Modules\Cards\Entities\Card;

/**
 * Class GeneratorHelper
 */
class GeneratorHelper
{
    /**
     * Takes data and combines it in request object.
     *
     * @return Request
     */
    public function createRequest(): Request
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add(
            [
                Card::NAME_FIELD => $this->getName(),
                Card::CODE_FIELD => $this->getCode(),
                Card::LIFE_FIELD => $this->getLife(),
                Card::MORAL_FIELD => $this->getMoral(),
                Card::ABILITIES_RELATION => $this->getAbilities(),
                Card::STRENGTH_FIELD => $this->getStrength(),
                Card::CATEGORY_FIELD => $this->getCategory(),
                Card::PICTURE_FIELD => $this->getPicture(),
                Card::CARD_TYPE_FIELD => $this->getCardType(),
                Card::RARITY_TYPE_FIELD => $this->getRarity(),
            ]
        );

        return $request;
    }

    /**
     * Returns name as string.
     *
     * @return string
     */
    public function getName(): string
    {
        return 'Hereos the hero';
    }

    /**
     * Returns name as string.
     *
     * @return string
     */
    public function getCode(): string
    {
        return 'asdfasdf';
    }

    /**
     * Returns life as int.
     *
     * @return int
     */
    public function getLife(): int
    {
        return 10;
    }

    /**
     * Returns moral as int.
     *
     * @return int
     */
    public function getMoral(): int
    {
        return 50;
    }

    /**
     * Returns array of ability foreign ids.
     *
     * @return array
     */
    public function getAbilities(): array
    {
        return [
            [
                'name' => 'test1234',
                'ability' => 'test1234'
            ],
            [
                'name' => 'asdcasdc',
                'ability' => 'test'
            ]
        ];
    }

    /**
     * Returns strenth as int.
     *
     * @return int
     */
    public function getStrength(): int
    {
        return 80;
    }

    /**
     * Returns picture as string (file_path/url).
     *
     * @return string
     */
    public function getPicture(): string
    {
        return 'https://picsum.photos/id/237/200/300';
    }

    /**
     * Returns category as id.
     *
     * @return int
     */
    public function getCategory(): int
    {
        return 1;
    }

    /**
     * Returns card_type as id.
     *
     * @return int
     */
    public function getCardType(): int
    {
        return 1;
    }

    /**
     * Returns rarity as id.
     *
     * @return int
     */
    public function getRarity(): int
    {
        return 1;
    }
}
