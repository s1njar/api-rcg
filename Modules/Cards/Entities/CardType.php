<?php

namespace Modules\Cards\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class CardType
 * @package Modules\Cards\Entities
 */
class CardType extends Model
{
    public const NAME_FIELD = 'name';
    public const CODE_FIELD = 'code';

    protected $table = 'card_types';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::CODE_FIELD
    ];

    /**
     * @return HasMany
     */
    public function cards()
    {
        return $this->hasMany(Card::class);
    }
}
