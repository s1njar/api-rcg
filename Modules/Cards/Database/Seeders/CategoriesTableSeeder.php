<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_CATEGORY_VALUES = [
        [
            'Ancient Empire',
            'ancient_empire'
        ],
        [
            'Medieval',
            'medieval'
        ],
        [
            'Magican',
            'magican'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        foreach (self::DEFAULT_CATEGORY_VALUES as $value) {
            $this->insert($value[0], $value[1]);
        }
    }

    /**
     * @param string $name
     * @param string $code
     */
    private function insert(string $name, string $code)
    {
        DB::table('categories')->insertOrIgnore([
            'name' => $name,
            'code' => $code,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
