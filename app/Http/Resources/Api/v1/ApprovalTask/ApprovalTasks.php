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
        return [
            'id' => $this->id_task_1C,
            'name' => $this->name_task_1C,
            'type' => $this->type,
            'type_descriptions' => $this->type_descriptions,
            'initiator' => $this->initiator ? [
                'ad_login' => $this->initiator->getUserAdLogin(),
                'tab_no' => $this->initiator->getUserTabNo(),
                'full_name' => $this->initiator->getUserFullName(),
                'avatar' => $this->initiator->getUserAvatar()->toArray(),
            ] : null,
            'comment' => $this->task_comment_execution,
            'executor' => $this->executor_employee,
            'status' => $this->task_status,
            'created_at' => $this->Date,
        ];
    }
}
