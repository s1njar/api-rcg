<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class RaritiesTableSeederTableSeeder
 * @package Modules\Cards\Database\Seeders
 */
class RaritiesTableSeeder extends Seeder
{
    /**
     * If one of these will be changed note to change same in following class at switch case statement:
     * \Modules\Generator\Services\Generator\Attributes\TotalPowerGeneratorService::getRarityTotal
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'Bronze',
            'bronze'
        ],
        [
            'Silver',
            'silver'
        ],
        [
            'Gold',
            'gold'
        ],
        [
            'Legend',
            'legend'
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

        foreach (self::DEFAULT_RARITY_VALUES as $value) {
            $this->insert($value[0], $value[1]);
        }
    }

    /**
     * @param string $name
     * @param string $code
     */
    private function insert(string $name, string $code)
    {
        DB::table('rarities')->insertOrIgnore([
            'name' => $name,
            'code' => $code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
