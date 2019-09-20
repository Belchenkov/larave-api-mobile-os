<?php
/**
 * Created by black40x@yandex.ru
 * Date: 20/09/2019
 */

namespace App\Repositories\User;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticVisitRepository
{
    const VISIT_ENTER = 2;
    const VISIT_EXIT = 1;


    public function getVisitStatistic(User $user, $timestamp = null, $subDays = 14)
    {
        if (!$timestamp) {
            $fromDay = Carbon::now()->startOfDay();
        } else {
            $fromDay = Carbon::createFromTimestamp($timestamp)->startOfDay();
        }

        $toDay = $fromDay->copy()->subDays($subDays)->endOfDay();

        $employeeStatus = $user->load('employeeStatus')->employeeStatus;



        $visits = $user->skudEvents()
            ->select(['*', DB::raw('CAST(CAST(time as DATE) as varchar(10)) as date')])
            ->where(
                DB::raw("CAST(time as DATE)"),
                '<=',
                $fromDay->format('Y-m-d')
            )
            ->where(
                DB::raw("CAST(time as DATE)"),
                '>=',
                $toDay->format('Y-m-d')
            )
            ->orderBy('time', 'ASC')
            ->get()
            ->groupBy('date');

        $period = CarbonPeriod::create($toDay, $fromDay);

        $schedule = $this->getVisitSchedule($user);

        $result = collect([
            'schedule' => $schedule,
            'user_info' => collect([
                'name' => Auth::user()->phPerson ? Auth::user()->phPerson->full_name : null,
                'position' => Auth::user()->employee ? Auth::user()->employee->position : null
            ]),
            'days' => collect([]),
            'previous' => $toDay->startOfDay()->timestamp
        ]);

        foreach ($period as $date) {
            $day = $date->format('Y-m-d');

            if (isset($visits[$day])) {
                $result->get('days')->put($day, $this->getDayVisit($visits[$day], $schedule));
            } else {
                if ($holiday = $this->checkHolidayUser($employeeStatus, $date)) {
                    $result->get('days')->put($day, $holiday);
                } else
                    $result->get('days')->put($day, collect(['empty' => true, 'day_of_week' => $date->minDayName]));
            }
        }

        $result->put('days', $result->get('days')->reverse());

        return $result;
    }

    public function getDayVisit(Collection $events, \Illuminate\Support\Collection $schedule)
    {
        $inTime = 0;
        $outTime = 0;
        $lastEnter = null;
        $lastExit = null;
        $startDay = $events->where('direction', self::VISIT_ENTER)->first();
        $endDay = $events->where('direction', self::VISIT_EXIT)->last();
        $startDay = $startDay ? Carbon::createFromFormat('Y-m-d H:i:s.v', $startDay->time) : null;
        $endDay = $endDay ? Carbon::createFromFormat('Y-m-d H:i:s.v', $endDay->time) : null;
        $currentDay = $startDay ? $startDay->copy() : null;
        $lateTime = 0;
        $earlierTime = 0;

        foreach ($events as $event) {
            if ($event->direction == self::VISIT_ENTER) {
                $lastEnter = $event;

                if ($lastExit) {
                    $outTime += Carbon::createFromFormat('Y-m-d H:i:s.v', $event->time)
                        ->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s.v', $lastExit->time));
                }
            } else {
                $lastExit = $event;

                if ($lastEnter) {
                    $inTime += Carbon::createFromFormat('Y-m-d H:i:s.v', $event->time)
                        ->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s.v', $lastEnter->time));
                }
            }
        }

        if ($startDay && $schedule->get('schedule')) {
            $scheduleStartDay = $schedule->get('schedule')->first()->get('date_in');
            $lateTime = $startDay
                    ->setDay($scheduleStartDay->day)
                    ->setMonth($scheduleStartDay->month)
                    ->setYear($scheduleStartDay->year)
                    ->timestamp - $scheduleStartDay->timestamp;

            if ($lateTime < 0) $lateTime = 0;
        }

        if ($endDay && $schedule->get('schedule')) {
            $scheduleEndDay = $schedule->get('schedule')->last()->get('date_out');
            $earlierTime = $scheduleEndDay->timestamp - $endDay
                    ->setDay($scheduleEndDay->day)
                    ->setMonth($scheduleEndDay->month)
                    ->setYear($scheduleEndDay->year)
                    ->timestamp;

            if ($earlierTime < 0) $earlierTime = 0;
        }

        return collect([
            'enter_time' => $startDay ? $startDay->format('H:i:s') : null,
            'exit_time' => $endDay ? $endDay->format('H:i:s') : null,
            'work_time' => Carbon::createFromTimestampUTC($inTime)->format('H:i:s'),
            'idle_time' => Carbon::parse($outTime)->format('H:i:s'),
            'territory_time' => Carbon::parse($endDay->diffInSeconds($startDay))->format('H:i:s'),
            'is_late' => $lateTime != 0,
            'is_earlier' => $earlierTime != 0,
            'day_of_week' => $currentDay ? $currentDay->minDayName : null
        ]);
    }

    public function getVisitSchedule(User $user) {
        $schedules = $user->scheduleEmployee()->orderBy('date_in', 'ASC')->get();

        $result = collect([
            'name' => '',
            'schedule' => collect()
        ]);

        foreach ($schedules as $schedule) {
            $result->put('name', $schedule->schedule_name);

            $result->get('schedule')->put(null, collect([
                'date_in' => Carbon::createFromFormat('Y-m-d H:i:s.v', $schedule->date_in),
                'date_out' => Carbon::createFromFormat('Y-m-d H:i:s.v', $schedule->date_out),
            ]));
        }
        return $result;
    }

    public function checkHolidayUser(Collection $holidays, Carbon $date)
    {
        foreach ($holidays as $holiday) {
            if ($date->between(Carbon::parse($holiday->date_start)->startOfDay(), Carbon::parse($holiday->date_end)->endOfDay())) return collect([
                'holiday' => true,
                'doc_num' => trim($holiday->doc_num),
                'status' => $holiday->status,
                'day_of_week' => $date->minDayName,
            ]);
        }

        return false;
    }
}
