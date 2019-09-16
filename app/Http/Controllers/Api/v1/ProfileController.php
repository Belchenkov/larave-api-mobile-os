<?php


namespace App\Http\Controllers\Api\v1;

use App\Http\Resources\Api\v1\Profile\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Api\v1
 * Profile info (Личная кадровая информация)
 */
class ProfileController
{
    /**
     * Get Profile Info for Auth User
     * @return mixed
     */
    public function getProfileInfo()
    {
        return Cache::remember('getProfileInfo', config('cache.cache_time'), function () {
            return new Profile(Auth::user()->load('phPerson', 'employee', 'department', 'employeeStatus', 'employeeChief'));
        });
    }

    /**
     * Get Statistic Visit User
     * @return mixed
     */
    public function getStatisticsVisitInfo()
    {
        $statisticData = Auth::user()->load('scheduleEmployee');

        if ($scheduleEmployee = $statisticData->scheduleEmployee) {
            $scheduleEmployee = $statisticData->scheduleEmployee->map(function ($schedule) {
                $result = collect();
                $result->put('date', Carbon::parse($schedule['date_in'])->format('d-m-Y'));
                $result->put('time_in', Carbon::parse($schedule['date_in'])->toTimeString());
                $result->put('time_out', Carbon::parse($schedule['date_out'])->toTimeString());

                return $result;
            });
        }

        $scheduleEmployeeGroupDate = $scheduleEmployee->groupBy('date');
        $result = collect();

        $scheduleEmployeeGroupDate = $scheduleEmployeeGroupDate->map(function ($date, $indexDate) use ($result) {
            $countTimes = count($date);

            if ($countTimes < 1) {
                return;
            }

            $result->put($indexDate, collect([
                'times' => $date,
                'work_times' => collect(),
                'free_times' => collect()
            ]));

            $prevTime = null;
            for ($i = 0; $i < $countTimes; $i++) {
                $curTime = $date[$i];

                $curDateTimeIn = Carbon::parse($curTime['time_in']);
                $curDateTimeOut = Carbon::parse($curTime['time_out']);

                // Рассчитываем рабочее время
                $curWorkDatetime = $curDateTimeOut->diffInSeconds($curDateTimeIn);
                $result[$indexDate]['work_times']->push($curWorkDatetime);

                // Расчитываем нерабочее время
                if ($prevTime) {
                    $prevDateTimeIn = Carbon::parse($prevTime['time_in']);
                    $prevDateTimeOut = Carbon::parse($prevTime['time_out']);
                    $freeTime = $curDateTimeIn->diffInSeconds($prevDateTimeOut);
                    $result[$indexDate]['free_times']->push($freeTime);
                }
                $prevTime = $curTime;
            }

            $result[$indexDate]['work_times'] = Carbon::parse($result[$indexDate]['work_times']->sum())->format('H:i:s');
            $result[$indexDate]['free_times'] = Carbon::parse($result[$indexDate]['free_times']->sum())->format('H:i:s');

            return $result;
        });

        return  Cache::remember('getStatisticsVisitInfo', config('cache.cache_time'), function () use ($scheduleEmployeeGroupDate) {
            return $scheduleEmployeeGroupDate->first();
        });
    }
}
