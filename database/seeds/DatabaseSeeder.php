<?php

use Illuminate\Database\Seeder;
use Modules\Cards\Database\Seeders\CardTypesTableSeeder;
use Modules\Cards\Database\Seeders\CategoriesTableSeeder;
use Modules\Cards\Database\Seeders\RaritiesTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CardTypesTableSeeder::class,
            CategoriesTableSeeder::class,
            RaritiesTableSeeder::class,
        ]);
    }
}
