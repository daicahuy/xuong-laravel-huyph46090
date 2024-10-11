<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentsIds = DB::table('students')->pluck('id')->all();

        foreach ($studentsIds as $id) {

            $issuedDate = Carbon::parse(fake()->date());

            DB::table('passports')->insert([
                'student_id' => $id,
                'passport_number' => strtoupper(fake()->unique()->bothify('??#######')),
                'issued_date' => $issuedDate,
                'expiry_date' => $issuedDate->addYear(4)
            ]);

        }
    }
}
