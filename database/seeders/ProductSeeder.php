<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(['name' => 'table', 'price' => 280]);
        Product::create(['name' => 'chair', 'price' => 100]);
        Product::create(['name' => 'frame', 'price' => 65]);
        Product::create(['name' => 'pen', 'price' => 1.15]);
        Product::create(['name' => 'pencil', 'price' => 0.80]);
        Product::create(['name' => 'rubber', 'price' => 0.75]);
    }
}
