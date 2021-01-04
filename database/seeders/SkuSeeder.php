<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class SkuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('skus')->insert(
            [
                'product_id' => 1,
                'sku' => '1-Notebook-Dell',
                'price' => 4599.90,
                'stock' => 150
            ]
        );
    }
}
