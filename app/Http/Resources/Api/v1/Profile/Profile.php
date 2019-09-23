<?php

namespace App\Http\Resources\Api\v1\Profile;

use App\Http\Resources\JsonApiResourse;
use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class Profile
 * @package App\Http\Resources\Api\v1\Profile
 *  Get Profile Info
 */
class Profile extends JsonApiResourse
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'fullName' => $this->getAttribute('phPerson.full_name'),
            'position' => $this->getAttribute('employee.position'),
            'unit' => $this->getAttribute('employeeChief.employeeChiefDepartment.Name'),
            'address_office' => $this->getOfficeAddress($this->getAttribute('coreUserData.Office')),
            'cabinet' => $this->getCabinet($this->getAttribute('coreUserData.Office')),
            'work_phone' => $this->getAttribute('phPerson.phone_internal'),
            'mobile_phone' => $this->getAttribute('phPerson.phone_mobile'),
            'amount_holiday_days' => null, // должны предоставить информацию
            'schedule' => $this->getAttribute('employee.schedule'),
            'status' => $this->getStatus(),
            'avatar_str' => $this->getAvatarName($this->getAttribute('phPerson.full_name')),
            'chief' => $this->getAttribute('employeeChief.employeeChiefInfo.phPerson.full_name')
        ];
    }

    /**
     * @param string|null $office
     * @return string|null
     * Get Office Address
     */
    public function getOfficeAddress(?string $office)
    {
        if (strpos($office, '/')) {
            return trim(explode('/', $office)[0], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[0], ' ');
        }

        return $office;
    }

    /**
     * @param string|null $office
     * @return string|null
     * Get Cabinet
     */
    public function getCabinet(?string $office)
    {
        if (strpos($office, '/')) {
            return trim(explode('/', $office)[1], ' ');
        } elseif (strpos($office, '\\')) {
            return trim(explode('\\', $office)[1], ' ');
        }

        return null;
    }

    /**
     * @return string|null
     * Get Status Employee
     */
    public function getStatus()
    {
        $employeeStatus = $this->load('employeeStatus')->employeeStatus;

        $holidays = (new StatisticVisitRepository)->checkHolidayUser($employeeStatus, Carbon::now());  // Check - Carbon::parse('2019-03-11')

        return !!$holidays ? $holidays['status'] : 'Работает';
    }

    /**
     * @param string|null $fullName
     * @return string|null
     * Get Short Full Name
     */
    public function getAvatarName(?string $fullName): ?string
    {
        if ($fullName) {
            $splitFullName = explode(' ', $fullName);

            return mb_substr($splitFullName[0], 0, 1) . mb_strtolower(mb_substr($splitFullName[1], 0, 1));
        }

        return null;
    }
}

