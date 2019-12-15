<?php

namespace Modules\Cards\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CardTypesSeederTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_RARITY_VALUES = [
        [
            'Monster',
            'monster'
        ],
        [
            'Magic',
            'magic'
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
            'code' => $code
        ]);
    }
}
