<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CardTypesTableSeeder extends Seeder
{
    /**
     * If one of these will be changed note to change same in following class:
     * \Modules\Generator\Services\Generator\Attributes\LifeGeneratorService
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'Light Melee Infantry',
            'light_melee_infantry'
        ],
        [
            'Heavy Melee Infantry',
            'heavy_Melee_infantry'
        ],
        [
            'Light Distance Infantry',
            'light_distance_infantry'
        ],
        [
            'Heavy Distance Infantry',
            'heavy_distance_infantry'
        ],
        [
            'Cavalry',
            'cavalry'
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
        DB::table('card_types')->insertOrIgnore([
            'name' => $name,
            'code' => $code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
