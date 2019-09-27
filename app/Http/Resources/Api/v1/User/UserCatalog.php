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
        $color = $this->getAvatarColor();

        return [
            'in_office' => $this->isUserOnline(),
            'full_name' => $this->full_name,
            'department_name' => $this->getDepartment(),
            'avatar' => [
                'name' => $this->getShortName(),
                'background' => $color[0],
                'color' => $color[1],
            ],
            'position' => $this->getPosition(),
            'tab_no' => $this->getTabNo(),
            'id_phperson' => $this->id_phperson,
            'department_guid' => $this->department_guid,
            'department_guid_real' => $this->realDepartment->department->id_1c,
        ];
    }
}
