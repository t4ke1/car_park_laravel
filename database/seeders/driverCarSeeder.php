<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class driverCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            DB::table('drivers')->insert([
                'name' => 'driver'.$i,
            ]);

            $dataType = ['economy', 'elite', 'luxury'];
            $dataModel = ['lada', 'gaz', 'zil'];
            DB::table('cars')->insert([
                'driver_id' => $i,
                'model' => $dataModel[rand(0, 2)],
                'comfort_type' => $dataType[rand(0, 2)],
            ]);

            DB::table('drivers')->where('id', $i)->update(['car_id' => $i]);
        }
    }
}
