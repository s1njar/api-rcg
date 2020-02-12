<?php

namespace Modules\Cards\Services;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Cards\Entities\Card;
use Modules\Cards\Entities\CardType;
use Modules\Cards\Entities\Category;
use Modules\Cards\Entities\Rarity;
use Throwable;

/**
 * Class CreateCardService
 */
class CardRepositoryService
{
    /**
     * Creates new card.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $card = new Card();

        $flat = $request->only([
            Card::NAME_FIELD,
            Card::CODE_FIELD,
            Card::LIFE_FIELD,
            Card::MORAL_FIELD,
            Card::STRENGTH_FIELD,
            Card::PICTURE_FIELD,
        ]);

        $relations = $request->only([
            Card::CATEGORY_FIELD,
            Card::CARD_TYPE_FIELD,
            Card::RARITY_TYPE_FIELD,
            Card::ABILITIES_RELATION
        ]);

        $isSaved = $card->fill($flat)->saveOrFail();

        $card
            ->category()
            ->associate(
                Category::where(
                    'id',
                    $relations[Card::CATEGORY_FIELD]
                )->first()
            );

        $card
            ->cardType()
            ->associate(
                CardType::where(
                    'id',
                    $relations[Card::CARD_TYPE_FIELD]
                )->first()
            );

        $card
            ->rarity()
            ->associate(
                Rarity::where(
                    'id',
                    $relations[Card::RARITY_TYPE_FIELD]
                )->first()
            );

        $card
            ->abilities()
            ->createMany(
                $relations[Card::ABILITIES_RELATION]
            );

        if (!$isSaved || !$card->saveOrFail()) {
            return response()->json(['status' => 'error', 'message' => 'Created card could not be saved'], 500);
        }

        return response()->json([
            'status' => 'ok',
            'card' => $card->getAttributes()
        ]);
    }

    /**
     *
     */
    public function search(): JsonResponse
    {
        $cards = Card::all();

        return response()->json([
            'status' => 'ok',
            'cards' => $cards->all()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function searchById(int $id): JsonResponse
    {
        /** @var Card $card */
        $card = Card::find($id);

        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'The card you searched for could not be found'
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'card' => $card->getAttributes()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $id): JsonResponse
    {
        /** @var Card $card */
        $card = Card::find($id);

        if (!$card) {
            return response()->json([
                'status' => 'error',
                'message' => 'The card you wanted to delete could not be found'
            ], 404);
        }

        $card->delete();

        return response()->json([
            'status' => 'ok',
            'card' => $card->getAttributes()
        ], 404);
    }
}
