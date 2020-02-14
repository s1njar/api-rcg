<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class CardTypesTableSeeder
 */
class CardTypesTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'name' => 'Light Melee Infantry',
            'code' => 'light_melee_infantry'
        ],
        [
            'name' => 'Heavy Melee Infantry',
            'code' => 'heavy_Melee_infantry'
        ],
        [
            'name' => 'Light Distance Infantry',
            'code' => 'light_distance_infantry'
        ],
        [
            'name' => 'Heavy Distance Infantry',
            'code' => 'heavy_distance_infantry'
        ],
        [
            'name' => 'Cavalry',
            'code' => 'cavalry'
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
        DB::table('card_types')->updateOrInsert(
            [
                'code' => $code
            ],
            [
                'name' => $name,
                'code' => $code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
    }
}
