<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $quantity = [1, 4, 5, 7];
        $prices = [2000000, 1500000, 5000000, 8000000];
        $taxes = [600000, 300000, 500000, 1600000];
        $dates = ['2024-09-15', '2024-09-16', '2024-09-18', '2024-09-20'];

        for ($i = 0; $i < 4; $i++) {
            DB::table('sales')->insert([
                'product_id' => $i+1,
                'quantity' => $quantity[$i],
                'price' => $prices[$i],
                'tax' => $taxes[$i],
                'total' => ($quantity[$i] * $prices[$i]) + $taxes[$i],
                'sale_date' => $dates[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
