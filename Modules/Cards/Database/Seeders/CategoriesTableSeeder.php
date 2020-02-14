<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class CategoriesTableSeeder
 */
class CategoriesTableSeeder extends Seeder
{
    /**
     *
     */
    private const DEFAULT_CATEGORY_VALUES = [
        [
            'name' => 'Ancient Empire',
            'code' => 'ancient_empire'
        ],
        [
            'name' => 'Medieval',
            'code' => 'medieval'
        ],
        [
            'name' => 'Magican',
            'code' => 'magican'
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
        DB::table('categories')->updateOrInsert(
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
