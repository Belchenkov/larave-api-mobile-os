<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\JsonApiResourse;

/**
 * Class Profile
 * @package App\Http\Resources\Api\v1\Profile
 *  Get Profile Info
 */
class UserProfile extends JsonApiResourse
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $color = $this->getAvatarColor();

        return [
            'in_office' => $this->isUserOnline(),
            'full_name' => $this->getFullName(),
            'avatar' => [
                'name' => $this->getShortName(),
                'background' => $color[0],
                'color' => $color[1],
            ],
            'position' => $this->getPosition(),
            'unit' => $this->getDepartment(),
            'email' => $this->getEmail(),
            'address_office' => $this->getOfficeAddress(),
            'cabinet' => $this->getCabinet(),
            'work_phone' => $this->getWorkPhone(),
            'mobile_phone' => $this->getMobilePhone(),
            'amount_holiday_days' => $this->getCountHolidayDays(),
            'schedule' => $this->getSchedule(),
            'status' => $this->getStatus(),
            'is_chief' => $this->isChief(),
            'chief' => $this->getChiefName(),
            'chief_main' => $this->getChiefMainName(),
            'tab_no' => $this->tab_no,
            'id_phperson' => $this->id_phperson,
            'department_guid' => $this->department_guid,
            'department_guid_real' => $this->getRealDepartmentGuid(),
        ];
    }


}

