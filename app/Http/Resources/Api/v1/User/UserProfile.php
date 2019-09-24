<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\JsonApiResourse;
use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;

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
            'fullName' => $this->getFullName(),
            'avatar' => [
                'name' => $this->getShortName(),
                'background' => $color[0],
                'color' => $color[1],
            ],
            'position' => $this->getPosition(),
            'unit' => $this->getAttribute('employeeChief.employeeChiefDepartment.Name'),
            'address_office' => $this->getOfficeAddress(),
            'cabinet' => $this->getCabinet(),
            'work_phone' => $this->getAttribute('phPerson.phone_internal'),
            'mobile_phone' => $this->getAttribute('phPerson.phone_mobile'),
            'amount_holiday_days' => null, // должны предоставить информацию
            'schedule' => $this->getSchedule(),
            'status' => $this->getStatus(),
            'chief' => $this->getAttribute('employeeChief.employeeChiefInfo.phPerson.full_name')
        ];
    }
}

