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
            'fullName' => $this->phPerson ? $this->phPerson->full_name : [],
            'position' => $this->employee ? $this->employee->position : [],
            'unit' => $this->department ? $this->department->Name : [],
            'address_office' => $this->phPerson ? $this->phPerson->office : [],
            'cabinet' => $this->phPerson ? $this->phPerson->room : [],
            'work_phone' => $this->phPerson ? $this->phPerson->phone_internal : [],
            'mobile_phone' => $this->phPerson ? $this->phPerson->phone_mobile : [],
            'amount_holiday_days' => 28, // пока в таблицах не нашел
            'schedule' => $this->employee ? $this->employee->schedule : [],
            'status' => $this->employeeStatus ? $this->employeeStatus->status : [],
            'chief' => $this->employeeChief ? $this->employeeChief->employeeChiefInfo->phPerson->full_name : []
            /* А вот здесь связь по IDENTIFIER отработала верно, стало быть связь верная и по IDENTIFIER ларавел связывает
             И думаю надо проверку на пустоту эту цепочку проверять в каком-то хелпере */

        ];
    }
}
