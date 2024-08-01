<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            driverCarSeeder::class,
            job_titleSeeder::class,
            employeeSeeder::class,
            carJobIdSeeder::class,
            driveTimeSeeder::class,
        ]);
    }
}
