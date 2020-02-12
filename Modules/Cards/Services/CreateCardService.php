<?php

namespace Modules\Cards\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cards\Entities\Card;
use Modules\Cards\Entities\CardType;
use Modules\Cards\Entities\Category;
use Modules\Cards\Entities\Rarity;
use Modules\Cards\Services\Interfaces\CreateCardServiceInterface;
use Throwable;

/**
 * Class CreateCardService
 */
class CreateCardService implements CreateCardServiceInterface
{
    /**
     * @var Card
     */
    private $card;

    /**
     * CreateCardService constructor.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * Creates new card.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $flat = $request->only([
            Card::NAME_FIELD,
            Card::LIFE_FIELD,
            Card::MORAL_FIELD,
            Card::STRENGTH_FIELD,
            Card::PICTURE_FIELD,
        ]);

        $relations = $request->only([
            Card::CATEGORY_FIELD,
            Card::CARD_TYPE_FIELD,
            Card::RARITY_TYPE_FIELD,
            Card::ABILITIES_FIELD
        ]);

        $isSaved = $this->card->fill($flat)->saveOrFail();

        $this->card->category()->associate(Category::where('code', $relations[Card::CATEGORY_FIELD])->first());

        $this->card->cardType()->associate(CardType::where('code', $relations[Card::CARD_TYPE_FIELD])->first());

        $this->card->rarity()->associate(Rarity::where('code', $relations[Card::RARITY_TYPE_FIELD])->first());

        $this->card->abilities()->createMany($relations[Card::ABILITIES_FIELD]);

        if (!$isSaved || !$this->card->saveOrFail()) {
            return response()->json(['status' => 'error', 'message' => 'Created card could not be saved'], 500);
        }

        return $this->respond($this->card);
    }

    /**
     * @param Card $card
     * @return JsonResponse
     */
    private function respond(Card $card): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'card' => $card->getAttributes()
        ]);
    }
}