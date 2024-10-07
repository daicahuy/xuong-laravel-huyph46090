<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $description = [
            'Nhập hàng tháng 9',
            'Chi phí vận chuyển',
            'Bảo hành sản phẩm',
            'Lương nhân viên tháng 9',
        ];

        $amounts = [5000000, 1000000, 800000, 12000000];

        $expense_dates = ['2024-09-05', '2024-09-10', '2024-09-12', '2024-09-12'];

        for ($i = 0; $i < 4; $i++) {
            DB::table('expenses')->insert([
                'description' => $description[$i],
                'amount' => $amounts[$i],
                'expense_date' => $expense_dates[$i],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
