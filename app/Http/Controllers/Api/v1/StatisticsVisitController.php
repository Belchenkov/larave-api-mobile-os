<?php


namespace App\Http\Controllers\Api\v1;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

/**
 * Class StatisticsVisitController
 * @package App\Http\Controllers\Api\v1
 *  Статистика посещаемости
 */

class StatisticsVisitController
{
    public function getStatisticsVisitInfo()
    {
        $statisticData = Auth::user()->load('scheduleEmployee');

        if ($scheduleEmployee = $statisticData->scheduleEmployee) {
            $scheduleEmployee = $statisticData->scheduleEmployee->map(function ($schedule, $index) {
                $result = collect();
                $result->put('date', Carbon::parse($schedule['date_in'])->format('d-m-Y'));
                $result->put('time_in', Carbon::parse($schedule['date_in'])->toTimeString());
                $result->put('time_out', Carbon::parse($schedule['date_out'])->toTimeString());

                return $result;
            });
        }
        $scheduleEmployeeGroupDate = $scheduleEmployee->groupBy('date');

        $scheduleEmployeeGroupDate = $scheduleEmployeeGroupDate->each(function ($item, $index) use($scheduleEmployeeGroupDate) {
            $item->each(function ($item) use($scheduleEmployeeGroupDate, $index) {
                $timeTerritoryIn = '';
                $timeTerritoryOut = '';
                $startTime = Carbon::parse($item['time_in']);
                $finishTime = Carbon::parse($item['time_out']);

                $totalDuration = gmdate('H:i:s', $finishTime->diffInSeconds($startTime));

                if (isset($scheduleEmployeeGroupDate[$index]['time_territory_in'])) {
                    $totalDuration = Carbon::createFromFormat('H:i:s', $scheduleEmployeeGroupDate[$index]['time_territory_in'])
                        ->addHours(Carbon::createFromFormat('H:i:s', $totalDuration)->format('H'));
                }


                $scheduleEmployeeGroupDate[$index]->put('time_territory_in', Carbon::parse($totalDuration)->format('H:i:s'));
                $scheduleEmployeeGroupDate[$index]->put('time_territory_out', '');
            });

        });
        return $scheduleEmployeeGroupDate;
    }
}
