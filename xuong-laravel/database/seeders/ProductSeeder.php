<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $productsName = ['Bàn Gỗ', 'Ghế xoay', 'Tủ quần áo', 'Giường ngủ'];
        $prices = [20000000, 15000000, 50000000, 80000000];

        for ($i = 0; $i < count($productsName); $i++) {
            DB::table('products')->insert([
                'name' => $productsName[$i],
                'price' => $prices[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

    }
}
