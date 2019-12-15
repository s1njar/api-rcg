<?php

namespace Modules\Cards\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Card
 * @package Modules\Cards\Entities
 */
class Card extends Model
{
    public const NAME_FIELD = 'name';
    public const LIFE_FIELD = 'life';
    public const COSTS_FIELD = 'costs';
    public const ABILITIES_FIELD = 'abilities';
    public const STRENGTH_FIELD = 'strength';
    public const CATEGORY_FIELD = 'category';
    public const PICTURE_FIELD = 'picture';

    protected $table = 'cards';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::LIFE_FIELD,
        self::COSTS_FIELD,
        self::ABILITIES_FIELD,
        self::STRENGTH_FIELD,
        self::CATEGORY_FIELD,
        self::PICTURE_FIELD,
    ];

    /**
     * @return BelongsToMany
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }

    /**
     * @return BelongsTo
     */
    public function cardType()
    {
        return $this->belongsTo(CardType::class);
    }

    /**
     * @return BelongsTo
     */
    public function rarity()
    {
        return $this->belongsTo(Rarity::class);
    }
}
