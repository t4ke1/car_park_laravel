<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class carJobIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $carEconomy = DB::table('cars')->where('comfort_type', 'economy')->pluck('id')->toArray();
        $countEconomy = count($carEconomy);
        $carLuxury = DB::table('cars')->where('comfort_type', 'luxury')->pluck('id')->toArray();
        $countLuxury = count($carLuxury);
        $carElite = DB::table('cars')->where('comfort_type', 'elite')->pluck('id')->toArray();
        $countElite = count($carElite);

        //car with job id 1

        for ($i = 0; $i < $countEconomy; $i++) {
            DB::table('car_job_titles')->insert([
                'job_title_id' => 1,
                'car_id' => $carEconomy[$i],
            ]);
        }

        //car with job id 2

        for ($i = 0; $i < $countEconomy; $i++) {
            DB::table('car_job_titles')->insert([
                'job_title_id' => 2,
                'car_id' => $carEconomy[$i],
            ]);
        }
        for ($i = 0; $i < $countLuxury; $i++) {
            DB::table('car_job_titles')->insert([
                'job_title_id' => 2,
                'car_id' => $carLuxury[$i],
            ]);
        }

        //car with job id 3
        for ($i = 0; $i < $countLuxury; $i++) {
            DB::table('car_job_titles')->insert([
                'job_title_id' => 3,
                'car_id' => $carLuxury[$i],
            ]);
        }
        for ($i = 0; $i < $countElite; $i++) {
            DB::table('car_job_titles')->insert([
                'job_title_id' => 3,
                'car_id' => $carElite[$i],
            ]);
        }
    }
}
