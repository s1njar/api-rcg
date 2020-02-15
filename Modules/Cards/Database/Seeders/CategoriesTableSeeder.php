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
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = json_decode(
            file_get_contents(
                storage_path() . '/app/seeder/categories.json'
            ),
            true
        )['categories'];

        foreach ($categories as $category) {
            $this->insert(
                $category['name'],
                $category['code']
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
