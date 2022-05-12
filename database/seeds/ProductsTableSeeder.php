<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'title' => 'Product1',
            'slug' => 'Product-1',
            'details' => 'This is details 1 2 3',
            'price' => 10000,
            'description' => 'bla bla bla!'
        ])->categories()->attach(1);
    }
}
