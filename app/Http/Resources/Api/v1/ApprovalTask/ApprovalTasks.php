<?php

namespace App\Http\Resources\Api\v1\ApprovalTask;

use App\Http\Resources\JsonApiResourse;

class ApprovalTasks extends JsonApiResourse
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $color = false;

        if ($this->initiator && $this->initiator->employee)
            $color = $this->initiator->employee->getAvatarColor();

        return [
            'id' => $this->id_task_1C,
            'name' => $this->name_task_1C,
            'type' => $this->type,
            'type_descriptions' => $this->type_descriptions,
            'initiator' => $color ? [
                'ad_login' => $this->employee,
                'tab_no' => $this->initiator->tab_no,
                'full_name' => $this->initiator->employee->getFullName(),
                'avatar' => [
                    'name' => $this->initiator->employee->getShortName(),
                    'background' => $color[0],
                    'color' => $color[1],
                    'image' => $this->initiator->employee->getUserAvatar(true),
                ],
            ] : null,
            'comment' => $this->task_comment_execution,
            'executor' => $this->executor_employee,
            'status' => $this->task_status,
            'created_at' => $this->Date,
        ];
    }
}
