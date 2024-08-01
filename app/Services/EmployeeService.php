<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employees;
use App\Models\Job_Title;
use App\Repositories\Drive_timeRepository;

readonly class EmployeeService
{
    public function __construct(
        private Drive_timeRepository $drive_times
    ) {}

    /**
     * @throws NotFoundException
     */
    public function getAutoList(EmployeeRequest $request, int $id): array
    {

        $startDate = $request->startDate;
        $startTime = $request->startTime;
        $endTime = $request->endTime;
        $model = $request->model;
        $comfortType = $request->comfortType;

        $employee = Employees::find($id);
        if ($employee === null) {
            throw new NotFoundException;
        }
        $jobId = $employee->job_id;
        $jobTitle = Job_Title::find($jobId);

        $availableCarCollection = $jobTitle->cars;

        $availableCarId = $availableCarCollection->pluck('id')->toArray();

        $availableCarIdByTime = $this->drive_times->getAvailableCarsByDate($startDate, $startTime, $endTime, $availableCarId);
        if (empty($availableCarIdByTime)) {
            return [];
        }

        switch (true) {
            case $model === null && $comfortType === null:
                return $availableCarIdByTime;

            case $model != null && $comfortType === null:

                $availableCarIdByModel = [];
                foreach ($availableCarCollection as $car) {
                    if ($car->model === $model) {
                        $availableCarIdByModel[] = $car->id;
                    }
                }
                if (empty($availableCarIdByModel)) {
                    return [];
                }

                return array_intersect($availableCarIdByModel,$availableCarIdByTime,);


            case $comfortType != null && $model === null:
                $availableCarIdByComfortType = [];
                foreach ($availableCarCollection as $car) {
                    if ($car->comfort_type === $comfortType) {
                        $availableCarIdByComfortType[] = $car->id;
                    }
                }
                if (empty($availableCarIdByComfortType)) {
                    return [];
                }

                return array_intersect($availableCarIdByTime, $availableCarIdByComfortType);

            case $comfortType != null && $model != null:
                $availableCarIdByComfortType = [];
                foreach ($availableCarCollection as $car) {
                    if ($car->comfort_type === $comfortType) {
                        $availableCarIdByComfortType[] = $car->id;
                    }
                }
                if (empty($availableCarIdByComfortType)) {
                    return [];
                }

                $availableCarIdByModel = [];
                foreach ($availableCarCollection as $car) {
                    if ($car->model === $model) {
                        $availableCarIdByModel[] = $car->id;
                    }
                }
                if (empty($availableCarIdByModel)) {
                    return [];
                }
                $filer = array_intersect($availableCarIdByTime, $availableCarIdByComfortType);

                return array_intersect($filer, $availableCarIdByModel);
        }

        return [];

    }
}
