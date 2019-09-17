<?php

namespace App\Http\Resources\Api\v1\Profile;

use App\Http\Resources\JsonApiResourse;

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
            'status' => $this->getAttribute('employeeStatus.status'),
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
}
