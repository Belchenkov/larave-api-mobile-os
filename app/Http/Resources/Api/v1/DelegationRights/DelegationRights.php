<?php

namespace App\Http\Resources\Api\v1\DelegationRights;

use App\Http\Resources\JsonApiResourse;
use Carbon\Carbon;

class DelegationRights extends JsonApiResourse
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
            'id' => $this->KeyRow,
            'from_whom' => $this->chiefDelegation ? [
                'ad_login' => $this->chiefDelegation->getUserAdLogin(),
                'tab_no' => $this->chiefDelegation->getUserTabNo(),
                'full_name' => $this->chiefDelegation->getUserFullName(),
                'avatar' => $this->chiefDelegation->getUserAvatar()->toArray(),
                'organisation' => $this->chiefDelegation->getUserOrganizationName(),
            ] : null,
            'on_whom' => $this->executorDelegation ? [
                'ad_login' => $this->executorDelegation->getUserAdLogin(),
                'tab_no' => $this->executorDelegation->getUserTabNo(),
                'full_name' => $this->executorDelegation->getUserFullName(),
                'avatar' => $this->executorDelegation->getUserAvatar()->toArray(),
                'organisation' => $this->executorDelegation->getUserOrganizationName(),
            ] : null,
            'period_start' => Carbon::parse($this->PeriodStart),
            'period_end' => Carbon::parse($this->PeriodEnd),
            'is_active' => (int) $this->is_active === 1,
            'created_at' => Carbon::parse($this->dt)
        ];
    }
}
