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
        return [
            'in_office' => $this->getUserOnline(),
            'online_office' => $this->getUserOnline() ? $this->getUserOnlineOfficeName() : null,
            'name' => [
                'full_name' => $this->getUserFullName(),
                'first_name' => $this->getUserFirstName(),
                'middle_name' => $this->getUserMiddleName(),
                'last_name' => $this->getUserLastName(),
            ],
            'avatar' => $this->getUserAvatar()->toArray(true),
            'position' => $this->getUserPosition(),
            'achive_has' => $this->attribut_1,
            'achive_desc' => $this->attribut_1_22,
            'achive_show' => $this->show_attribut_1 == 1,
            'unit' => $this->getUserUnit(),
            'email' => $this->email,
            'office_address' => $this->getUserOfficeTerritory(),
            'office_cabinet' => $this->getUserOfficeCabinet(),
            'phone_work' => $this->getUserPhoneWork(),
            'phone_mobile' => $this->getUserPhoneMobile(),
            'amount_holiday_days' => $this->getUserHolidaysCount(),
            'schedule' => $this->getUserSchedule(),
            'status' => $this->getUserStatus(),
            'is_chief' => $this->getUserIsManager(),
            'chief' => $this->getUserManagerSecondName(),
            'chief_id' => $this->getModelAttribute('managerSecond.id_phperson'),
            'chief_main' => $this->getUserManagerName(),
            'chief_main_id' => $this->getModelAttribute('manager.id_phperson'),
            'tab_no' => $this->getUserTabNo(),
            'organisation' => $this->getUserOrganizationName(),
            'id_phperson' => $this->getUserPhPerson(),
            'department_guid' => $this->getUserDepartmentId(),
        ];
    }


}

