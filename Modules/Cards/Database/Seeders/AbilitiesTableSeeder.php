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
            'ability' => 'Wähle eine Einheit aus, die sich danach schneller bewegen kann.',
            'type' => '1',
            'target' => '1',
            'calc_operator' => '+',
            'calc_value' => '1',
            'range' => '0',
            'target_attribute' => '',
            'target_card_type' => '',
            'source_rarity' => '',
            'source_card_type' => ''
        ],
        [
            'name' => 'Verlangsamung',
            'ability' => 'Wähle eine Einheit aus, die sich danach langsamer bewegt.',
            'type' => '1',
            'target' => '2',
            'calc_operator' => '-',
            'calc_value' => '1',
            'range' => '0',
            'target_attribute' => '',
            'target_card_type' => '',
            'source_rarity' => '',
            'source_card_type' => ''
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
     * @param $name
     * @param $ability
     * @param $type
     * @param $target
     * @param $calcOperator
     * @param $calcValue
     * @param $range
     * @param $targetAttribute
     * @param $targetCardType
     * @param $sourceRarity
     * @param $sourceCardType
     */
    private function insert(
        $name,
        $ability,
        $type,
        $target,
        $calcOperator,
        $calcValue,
        $range,
        $targetAttribute,
        $targetCardType,
        $sourceRarity,
        $sourceCardType
    ) {
        DB::table('abilities')->insertOrIgnore([
            'name' => $name,
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
        ]);
    }
}
