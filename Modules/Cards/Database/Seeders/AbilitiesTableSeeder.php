<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AbilitiesTableSeeder
 */
class AbilitiesTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_ABILITY_VALUES = [
        [
            'name' => 'Leichtgewicht',
            'code' => 'leichtgewicht',
            'ability' => 'Wähle eine Einheit aus, die sich danach schneller bewegen kann.',
            'type' => '1',
            'target' => '1',
            'calc_operator' => '+',
            'calc_value' => '1',
            'range' => '0',
            'target_attribute' => '',
            'target_card_type' => 0,
            'source_rarity' => 0,
            'source_card_type' => 0
        ],
        [
            'name' => 'Verlangsamung',
            'code' => 'verlangsamung',
            'ability' => 'Wähle eine Einheit aus, die sich danach langsamer bewegt.',
            'type' => '1',
            'target' => '2',
            'calc_operator' => '-',
            'calc_value' => '1',
            'range' => '0',
            'target_attribute' => '',
            'target_card_type' => 0,
            'source_rarity' => 0,
            'source_card_type' => 0
        ]
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach (self::DEFAULT_ABILITY_VALUES as $value) {
            $this->insert(
                $value['name'],
                $value['code'],
                $value['ability'],
                $value['type'],
                $value['target'],
                $value['calc_operator'],
                $value['calc_value'],
                $value['range'],
                $value['target_attribute'],
                $value['target_card_type'],
                $value['source_rarity'],
                $value['source_card_type']
            );
        }
    }

    /**
     * @param string $name
     * @param string $code
     * @param string $ability
     * @param int $type
     * @param int $target
     * @param string $calcOperator
     * @param int $calcValue
     * @param int $range
     * @param string $targetAttribute
     * @param int $targetCardType
     * @param int $sourceRarity
     * @param int $sourceCardType
     */
    private function insert(
        string $name,
        string $code,
        string $ability,
        int $type,
        int $target,
        string $calcOperator,
        int $calcValue,
        int $range,
        string $targetAttribute,
        int $targetCardType,
        int $sourceRarity,
        int $sourceCardType
    ) {
        DB::table('abilities')->updateOrInsert(
            [
                'code' => $code
            ],
            [
                'name' => $name,
                'code' => $code,
                'ability' => $ability,
                'type' => $type,
                'target' => $target,
                'calc_operator' => $calcOperator,
                'calc_value' => $calcValue,
                'range' => $range,
                'target_attribute' => $targetAttribute,
                'target_card_type' => $targetCardType,
                'source_rarity' => $sourceRarity,
                'source_card_type' => $sourceCardType,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
