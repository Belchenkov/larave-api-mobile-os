<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Services\User;


use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

trait UserInformationTrait
{
    /**
     * @return string
     */
    public function getShortName() : string
    {
        if (!$name = $this->getFullname()) return 'NA';

        $name = explode(' ', $name);
        if (count($name) >= 2) {
            return strtoupper(mb_substr($name[0], 0, 1) . mb_substr($name[1], 0, 1));
        }
        return strtoupper(mb_substr($name[0], 0, 1));
    }

    /**
     * @return string
     */
    public function getOfficeAddress() : ?string
    {
        $office = $this->getOffice();

        if (strpos($office, '/')) {
            return trim(explode('/', $office)[0], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[0], ' ');
        }

        return $office;
    }

    /**
     * @return string|null
     */
    public function getCabinet() : ?string
    {
        $office = $this->getOffice();

        if (strpos($office, '/')) {
            return trim(explode('/', $office)[1], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[1], ' ');
        }

        return null;
    }

    /**
     * @return mixed|string
     * Get Holidays User
     */
    public function getHolidays() : ?Collection
    {
        $holidays = null;

        if ($employeeStatus = $this->employeeStatus) {
            $holidays = (new StatisticVisitRepository)->checkHolidayUser($employeeStatus, Carbon::now());
        }

        return $holidays;
    }

    /**
     * @return int|null
     * Get Amount Holiday Days Employee
     */
    public function getCountHolidayDays() : ?int
    {
        if ($holidays = $this->getHolidays()) {
            $holidaysStart = Carbon::parse($holidays['date_start']);
            $holidaysEnd = Carbon::parse($holidays['date_end']);

            return $holidaysEnd->diffInDays($holidaysStart);
        }

        return null;
    }

    /**
     * @return string
     * Get Status Employee
     */
    public function getStatus() : string
    {
        return $this->getHolidays() ? $this->getHolidays()['status'] : 'Работает';
    }

    /**
     * @return bool
     */
    public function isUserOnline() : bool
    {
        if ($this->relationLoaded('skudEvents')) {
            if ($this->skudEvents->last() && $this->skudEvents->last()->direction == StatisticVisitRepository::VISIT_ENTER) return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isChief() : bool
    {
        if ($this->departmentChief->count() > 0) {
            return true;
        }

        return false;
    }
}
