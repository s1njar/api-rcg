<?php

namespace Modules\Cards\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Ability
 * @package Modules\Cards\Entities
 */
class Ability extends Model
{
    public const NAME_FIELD = 'name';
    public const ABILITY_FIELD = 'ability';

    protected $table = 'abilities';

    /**
     * @var array
     */
    protected $fillable = [
        self::NAME_FIELD,
        self::ABILITY_FIELD
    ];

    /**
     * @return BelongsToMany
     */
    public function cards()
    {
        return $this->belongsToMany(Card::class);
    }
}
