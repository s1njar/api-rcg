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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $abilities = json_decode(
            file_get_contents(
                storage_path() . '/app/seeder/abilities.json'
            ),
            true
        )['abilities'];

        foreach ($abilities as $ability) {
            $this->insert(
                $ability['name'],
                $ability['code'],
                $ability['ability'],
                $ability['type'],
                $ability['target'],
                $ability['calc_operator'],
                $ability['calc_value'],
                $ability['range'],
                $ability['target_attribute'],
                $ability['target_card_type'],
                $ability['source_rarity'],
                $ability['source_card_type']
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
