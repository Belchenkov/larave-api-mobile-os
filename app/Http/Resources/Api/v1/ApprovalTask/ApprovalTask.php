<?php

namespace App\Http\Resources\Api\v1\ApprovalTask;

use App\Http\Resources\JsonApiResourse;

class ApprovalTask extends JsonApiResourse
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
            'type_doc' => $this->type_doc,
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
            'actions' => $this->getRelevantActions('buttons'),
            'related_tasks' => $this->relatedTasks->map(function($item) {
                $color = false;
                if ($item->executor)
                    $color = $item->executor->employee->getAvatarColor();

                return [
                    'status' => $item->task_status,
                    'comment' => $item->task_comment_execution,
                    'user' => $color ? [
                        'full_name' => $item->executor->employee->getFullName(),
                        'avatar' => [
                            'name' => $item->executor->employee->getShortName(),
                            'background' => $color[0],
                            'color' => $color[1],
                            'image' => $item->executor->employee->getUserAvatar(true),
                        ],
                    ] : null
                ];
            }),
            'doc_info' => $this->getDocInfo(),
            'created_at' => $this->Date,
        ];
    }
}
