<?php

namespace Modules\Cards\Database\Seeders;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Cards\Entities\Rarity;

/**
 * Class RaritiesTableSeederTableSeeder
 */
class RaritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $rarities = json_decode(
            file_get_contents(
                storage_path() . '/app/seeder/rarities.json'
            ),
            true
        )['rarities'];

        foreach ($rarities as $rarity) {
            $this->insert(
                $rarity['name'],
                $rarity['code']
            );
        }
    }

    /**
     * @param string $name
     * @param string $code
     */
    private function insert(string $name, string $code)
    {
        DB::table('rarities')->updateOrInsert(
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
