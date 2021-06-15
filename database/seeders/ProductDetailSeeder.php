<?php

namespace Database\Seeders;

use App\Models\ProductDetail;
use Illuminate\Database\Seeder;

class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductDetail::factory()
            ->count(5)
            ->create();
    }
}
