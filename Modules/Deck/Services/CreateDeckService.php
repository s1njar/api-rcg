<?php

namespace Modules\Deck\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Account\Entities\User;
use Modules\Deck\Entities\Deck;
use Modules\Deck\Services\Interfaces\CreateDeckServiceInterface;
use Throwable;

/**
 * Class CreateDeckService
 * @package Modules\Deck\Services
 */
class CreateDeckService implements CreateDeckServiceInterface
{

    /**
     * @var Deck
     */
    private $deck;

    /**
     * CreateDeckService constructor.
     *
     * @param Deck $deck
     */
    public function __construct(Deck $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Create new deck by request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $flat = $request->only([
            Deck::NAME_FIELD,
            Deck::CODE_FIELD
        ]);

        $relations = $request->only([
            Deck::USER_FIELD,
            Deck::CARDS_RELATION
        ]);

        $isSaved = $this->deck->fill($flat)->saveOrFail();

        $this->deck->user()->associate(User::where('id', $relations[Deck::USER_FIELD])->first());

        $this->deck->cards()->sync($relations[Deck::CARDS_RELATION]);

        if (!$isSaved || !$this->deck->saveOrFail()) {
            return response()->json(['status' => 'error', 'message' => 'Entity deck could not be saved.'], 500);
        }

        return $this->respond($this->deck);
    }

    /**
     * @param Deck $deck
     * @return JsonResponse
     */
    private function respond(Deck $deck): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'deck' => $deck->getAttributes()
        ]);
    }
}