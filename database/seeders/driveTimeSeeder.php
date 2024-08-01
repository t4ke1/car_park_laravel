<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class driveTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        function randomTimeInRange($startTime, $endTime): string
        {
            $startTimestamp = strtotime($startTime);
            $endTimestamp = strtotime($endTime);
            $randomTimestamp = rand($startTimestamp, $endTimestamp);

            return date('H:i:00', $randomTimestamp);
        }

        $currentDate = Carbon::now();
        $startOfWeek = $currentDate->copy()->startOfWeek();
        $endOfWeek = $currentDate->copy()->endOfWeek();
        $daysOfWeek = [];

        for ($date = $startOfWeek; $date->lte($endOfWeek); $date->addDay()) {
            $daysOfWeek[] = $date->copy()->format('Y-m-d');
        }

        $workDays = [];
        foreach ($daysOfWeek as $day) {
            $carbonDay = Carbon::createFromFormat('Y-m-d', $day);
            if ($carbonDay->isWeekend()) {
                continue;
            }
            $workDays[] = $day;
        }
        $carId = DB::table('cars')->pluck('id')->toArray();
        foreach ($workDays as $day) {
            foreach ($carId as $id) {
                for ($i = 0; $i < rand(0, 1); $i++) {
                    $random_start_time = randomTimeInRange('08:00:00', '17:00:00');
                    $random_end_time = randomTimeInRange($random_start_time, '17:00:00');
                    DB::table('drive_times')->insert([
                        'car_id' => $id,
                        'date' => $day,
                        'start_time' => $random_start_time,
                        'end_time' => $random_end_time,
                    ]);
                }
            }
        }
    }
}
