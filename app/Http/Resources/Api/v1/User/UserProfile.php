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
            'full_name' => $this->getFullName(),
            'avatar' => [
                'name' => $this->getShortName(),
                'background' => $color[0],
                'color' => $color[1],
            ],
            'position' => $this->getPosition(),
            'unit' => $this->getDepartment(),
            'address_office' => $this->getOfficeAddress(),
            'cabinet' => $this->getCabinet(),
            'work_phone' => $this->getWorkPhone(),
            'mobile_phone' => $this->getMobilePhone(),
            'amount_holiday_days' => $this->getCountHolidayDays(),
            'schedule' => $this->getSchedule(),
            'status' => $this->getStatus(),
            'chief' => $this->getChiefName()
        ];
    }


}

