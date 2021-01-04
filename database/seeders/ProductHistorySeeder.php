<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ProductHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_histories')->insert(
            [
                'sku_id' => 1,
                'quantity' => 150,
                'action' => 'Adicionado pelo Seeder',
                'trigger' => 'Seeder',
            ]
        );
    }
}
