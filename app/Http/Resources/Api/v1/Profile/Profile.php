<?php

namespace App\Http\Resources\Api\v1\Profile;

use App\Http\Resources\JsonApiResourse;

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
            'unit' => $this->getAttribute('department.Name'),
            'address_office' => $this->getAttribute('phPerson.office'),
            'cabinet' => $this->getAttribute('phPerson.room'),
            'work_phone' => $this->getAttribute('phPerson.phone_internal'),
            'mobile_phone' => $this->getAttribute('phPerson.phone_mobile'),
            'amount_holiday_days' => 28, // пока в таблицах не нашел
            'schedule' => $this->getAttribute('employee.schedule'),
            'status' => $this->getAttribute('employeeStatus.status'),
            'chief' => $this->getAttribute('employeeChief.employeeChiefInfo.phPerson.full_name')
        ];
    }
}
