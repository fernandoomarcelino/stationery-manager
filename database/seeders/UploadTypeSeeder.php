<?php

namespace Database\Seeders;

use App\Models\UploadType;
use Illuminate\Database\Seeder;

class UploadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UploadType::create(['id' => UploadType::PRODUCT_PHOTO, 'name' => 'Product_image', 'public' => true]);
    }
}
