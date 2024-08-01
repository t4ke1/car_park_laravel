<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class job_titleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $job = ['developer', 'designer', 'manager'];

            DB::table('job_titles')->insert([
                'title' => $job[$i],
            ]);
        }
    }
}
