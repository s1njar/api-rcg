<?php

namespace Modules\Cards\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Ability
 */
class Ability extends Model
{
    public const NAME_FIELD = 'name';
    public const CODE_FIELD = 'code';
    public const ABILITY_FIELD = 'ability';
    public const TYPE_FIELD = 'type';
    public const TARGET_FIELD = 'target';
    public const CALC_OPERATOR_FIELD = 'calc_operator';
    public const CALC_VALUE_FIELD = 'calc_value';
    public const RANGE_FIELD = 'range';
    public const TARGET_ATTRIBUTE_FIELD = 'target_attribute';
    public const TARGET_CARD_TYPE_FIELD = 'target_card_type';
    public const SOURCE_RARITY_FIELD = 'source_rarity';
    public const SOURCE_CARD_TYPE_FIELD = 'source_card_type';

    protected $table = 'abilities';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::CODE_FIELD,
        self::ABILITY_FIELD,
        self::TYPE_FIELD,
        self::TARGET_FIELD,
        self::CALC_OPERATOR_FIELD,
        self::CALC_VALUE_FIELD,
        self::RANGE_FIELD,
        self::TARGET_ATTRIBUTE_FIELD,
        self::TARGET_CARD_TYPE_FIELD,
        self::SOURCE_RARITY_FIELD,
        self::SOURCE_CARD_TYPE_FIELD
    ];

    /**
     * @return BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
