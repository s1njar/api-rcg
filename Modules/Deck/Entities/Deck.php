<?php

namespace Modules\Deck\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Account\Entities\User;
use Modules\Cards\Entities\Card;

/**
 * Class Deck
 * @package Modules\Deck\Entities
 */
class Deck extends Model
{
    public const NAME_FIELD = 'name';
    public const CODE_FIELD = 'code';
    public const USER_FIELD = 'user_id';

    public const CARDS_RELATION = 'cards';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::CODE_FIELD,
        self::USER_FIELD
    ];

    /**
     * @return BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class, 'cards_decks');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
