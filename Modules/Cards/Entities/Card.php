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
    public const CODE_FIELD = 'code';
    public const LIFE_FIELD = 'life';
    public const MORAL_FIELD = 'moral';
    public const STRENGTH_FIELD = 'strength';
    public const SPEED_FIELD = 'speed';
    public const RANGE_FIELD = 'range';
    public const CATEGORY_FIELD = 'category_id';
    public const PICTURE_FIELD = 'picture';
    public const CARD_TYPE_FIELD = 'card_type_id';
    public const RARITY_TYPE_FIELD = 'rarity_id';

    public const ABILITIES_RELATION = 'abilities';

    protected $table = 'cards';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::CODE_FIELD,
        self::LIFE_FIELD,
        self::MORAL_FIELD,
        self::STRENGTH_FIELD,
        self::SPEED_FIELD,
        self::RANGE_FIELD,
        self::CATEGORY_FIELD,
        self::PICTURE_FIELD,
        self::CARD_TYPE_FIELD,
        self::RARITY_TYPE_FIELD,
    ];

    /**
     * @return BelongsToMany
     */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'cards_abilities');
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

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
