<?php

use Illuminate\Database\Seeder;
use App\Brands;
use Carbon\Carbon;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Brands::insert([
            ['Id' => '1', 'name' => '1', 'image' => '/img/Brands/Brand-1.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '2', 'name' => '2', 'image' => '/img/Brands/Brand-2.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '3', 'name' => '3', 'image' => '/img/Brands/Brand-3.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '4', 'name' => '4', 'image' => '/img/Brands/Brand-4.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '5', 'name' => '1', 'image' => '/img/Brands/Brand-1.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '6', 'name' => '2', 'image' => '/img/Brands/Brand-2.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '7', 'name' => '3', 'image' => '/img/Brands/Brand-3.svg', 'created_at' => $now, 'updated_at' => $now],
            ['Id' => '8', 'name' => '4', 'image' => '/img/Brands/Brand-4.svg', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
