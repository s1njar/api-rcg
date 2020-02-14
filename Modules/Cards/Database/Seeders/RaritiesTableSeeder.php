<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class RaritiesTableSeederTableSeeder
 */
class RaritiesTableSeeder extends Seeder
{
    /**
     * If one of these will be changed note to change same in following class at switch case statement:
     * \Modules\Generator\Services\Generator\Attributes\TotalPowerGeneratorService::getRarityTotal
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'name' => 'Bronze',
            'code' => 'bronze'
        ],
        [
            'name' => 'Silver',
            'code' => 'silver'
        ],
        [
            'name' => 'Gold',
            'code' => 'gold'
        ],
        [
            'name' => 'Legend',
            'code' => 'legend'
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
            $this->insert(
                $value['name'],
                $value['code']
            );
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
