<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
            ['name' => 'Trayse', 'slug' => 'trayse', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Towels and Tissue', 'slug' => 'towels and tissue', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Straws', 'slug' => 'straws', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Seasonal Products', 'slug' => 'seasonal products', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
