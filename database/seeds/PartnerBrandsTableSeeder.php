<?php

use Illuminate\Database\Seeder;
use App\Partner_Brands;

class PartnerBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner_Brands::create([
            'name' => 'Brand-1',
            'slug' => 'Brand-1',
        ]);

        Partner_Brands::create([
            'name' => 'Brand-2',
            'slug' => 'Brand-2',
        ]);

        Partner_Brands::create([
            'name' => 'Brand-3',
            'slug' => 'Brand-3',
        ]);

        Partner_Brands::create([
            'name' => 'Brand-4',
            'slug' => 'Brand-4',
        ]);
    }
}
