<?php

namespace Modules\Deck\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Account\Entities\User;
use Modules\Deck\Entities\Deck;
use Throwable;

/**
 * Class CreateDeckService
 */
class DeckRepositoryService
{
    /**
     * Create new deck by request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $deck = new Deck();

        $flat = $request->only([
            Deck::NAME_FIELD,
            Deck::CODE_FIELD
        ]);

        $relations = $request->only([
            Deck::USER_FIELD,
            Deck::CARDS_RELATION
        ]);

        DB::beginTransaction();

        $isSaved = $deck->fill($flat)->saveOrFail();

        try {
            $deck->user()->associate(User::where('id', $relations[Deck::USER_FIELD])->first());

            $deck->cards()->sync($relations[Deck::CARDS_RELATION]);

            $isRelationSaved = $deck->saveOrFail();
        } catch (QueryException $queryException) {
            DB::rollback();
            return response()
                ->json(
                    [
                        'status' => 'error',
                        'message' => 'Seems that some cards the deck contains, does not exist.'
                    ],
                    500
                );
        }

        if (!$isSaved || !$isRelationSaved) {
            DB::rollback();
            return response()->json(['status' => 'error', 'message' => 'Entity deck could not be saved.'], 500);
        }

        DB::commit();
        return response()->json([
            'status' => 'ok',
            'deck' => $deck->getAttributes()
        ]);
    }

    /**
     *
     */
    public function search(): JsonResponse
    {
        $deck = Deck::all();

        return response()->json([
            'status' => 'ok',
            'cards' => $deck->all()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function searchById(int $id): JsonResponse
    {
        /** @var Deck $deck */
        $deck = Deck::find($id);

        if (!$deck) {
            return response()->json([
                'status' => 'error',
                'message' => 'The deck you searched for could not be found'
            ]);
        }

        return response()->json([
            'status' => 'ok',
            'card' => $deck->getAttributes()
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $id): JsonResponse
    {
        /** @var Deck $deck */
        $deck = Deck::find($id);

        if (!$deck) {
            return response()->json([
                'status' => 'error',
                'message' => 'The deck you wanted to delete could not be found'
            ], 404);
        }

        $deck->delete();

        return response()->json([
            'status' => 'ok',
            'card' => $deck->getAttributes()
        ], 404);
    }
}
