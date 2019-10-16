<?php

namespace App\Http\Resources\Api\v1\User;

use App\Http\Resources\JsonApiResourse;

class UserCatalog extends JsonApiResourse
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
            'full_name' => $this->getUserFullName(),
            'email' => $this->email,
            'department_name' => $this->getUserUnit(),
            'avatar' => $this->getUserAvatar()->toArray(),
            'position' => $this->getUserPosition(),
            'organisation' => $this->getUserOrganizationName(),
            'tab_no' => $this->getUserTabNo(),
            'id_phperson' => $this->getUserPhPerson(),
            'department_guid' => $this->getUserDepartmentId()
        ];
    }
}
