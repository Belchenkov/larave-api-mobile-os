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
        $relatedTask = null;

        if ($this->relationLoaded('relatedTasksParent') && $this->relatedTasksParent->count() > 0) {
            $relatedTask = $this->relatedTasksParent;
        } elseif ($this->relationLoaded('relatedTasks') && $this->relatedTasks->count() > 0) {
            $relatedTask = $this->relatedTasks;
        }

        return [
            'id' => $this->id_task_1C,
            'name' => $this->name_task_1C,
            'type' => $this->type,
            'type_descriptions' => $this->type_descriptions,
            'type_doc' => $this->type_doc,
            'initiator' => $this->initiator ? [
                'ad_login' => $this->initiator->getUserAdLogin(),
                'tab_no' => $this->initiator->getUserTabNo(),
                'id_phperson' => $this->initiator->getUserPhPerson(),
                'full_name' => $this->initiator->getUserFullName(),
                'avatar' => $this->initiator->getUserAvatar()->toArray(),
                'organisation' => $this->initiator->getUserOrganizationName(),
            ] : null,
            'comment' => $this->task_comment_execution,
            'executor' => $this->executor_employee,
            'status' => $this->task_status,
            'actions' => $this->getRelevantActions('buttons'),
            'related_tasks' => $relatedTask ? $relatedTask->map(function($item) {
                return [
                    'status' => $item->task_status,
                    'comment' => $item->task_comment_execution,
                    'user' => $item->executor ? [
                        'id_phperson' => $item->executor->getUserPhPerson(),
                        'full_name' => $item->executor->getUserFullName(),
                        'avatar' => $this->executor->getUserAvatar()->toArray(),
                    ] : null
                ];
            }) : [],
            'doc_info' => $this->getDocInfo(),
            'created_at' => $this->Date,
        ];
    }
}
