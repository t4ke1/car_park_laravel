<?php

namespace App\Repositories;

use App\Models\Drive_times;

class Drive_timeRepository
{
    public function getAvailableCarsByDate(string $startDate, string $startTime, string $endTime, array $carIds): array
    {
        $availableCars = [];

        foreach ($carIds as $id) {
            $conflictingRides = Drive_times::where('car_id', $id)
                ->where('date', $startDate)
                ->where(function ($query) use ($startTime, $endTime) {
                    $query->where(function ($q) use ($startTime, $endTime) {
                        $q->where('start_time', '<=', $endTime)
                            ->where('end_time', '>=', $startTime);
                    });
                })
                ->exists();

            if (! $conflictingRides) {
                $availableCars[] = $id;
            }
        }

        return $availableCars;
    }
}
