<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class employeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {

            DB::table('employees')->insert([
                'name' => 'employee'.$i,
                'job_id' => rand(1, 3),
            ]);
        }
    }
}
