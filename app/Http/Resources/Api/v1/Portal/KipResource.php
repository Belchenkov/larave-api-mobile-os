<?php

namespace App\Http\Resources\Api\v1\Portal;

use App\Structure\User\UserAvatar;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class KipResource extends JsonResource
{

    public static function userFromItem($item)
    {
        try {
             return [
                'user_id' => $item['user_id'],
                'tab_no' => $item['tab_no'],
                'id_phperson' => $item['id_phperson'],
                'full_name' => $item['last_name'] . ' ' .
                    $item['first_name'] . ' ' .
                    $item['middle_name'],
                'avatar' => UserAvatar::fromFaker(
                    $item['last_name'],
                    $item['first_name'],
                    $item['middle_name'],
                    $item['tab_no'],
                    $item['id_phperson'],
                )->toArray(),
            ];
        } catch  (\Exception $e) {
        }

        return null;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'number' => $this['number'],
            'theme' => $this['theme'],
            'note' => $this['note'],
            'priority' => $this['priority'],
            'date_start' => $this['date_start'] ? Carbon::parse($this['date_start']) : null,
            'date_end' => $this['date_end'] ? Carbon::parse($this['date_end']) : null,
            'planned_date' => $this['planned_date'] ? Carbon::parse($this['planned_date']) : null,
            'fact_date' => $this['fact_date'] ? Carbon::parse($this['fact_date']) : null,
            'current_status_id' => $this['current_status_id'],
            'projectd' => $this['projectd'] ?
                [
                    'project_id' => $this['projectd']['project_id'],
                    'nm' => $this['projectd']['nm'],
                    'id_1c' => $this['projectd']['id_1c'],
                    'id_1c_parent' => $this['projectd']['id_1c_parent'],
                ] : null,
            'delegated' => $this['delegated'],
            'initiator_user' => $this['initiator_user'] ? self::userFromItem($this['initiator_user']) : null,
            'executor_user' => $this['executor_user'] ? self::userFromItem($this['executor_user']) : null,
            'is_complete' => $this['is_complete'],
            'is_overdue' => $this['is_overdue'],
            'is_archive' => $this['is_archive'],
            'files' => $this['files'],
            'assistants' => collect($this['assistants'])->map(function ($item) {
                return KipResource::userFromItem($item);
            }),
            'observers' => collect($this['observers'])->map(function ($item) {
                return KipResource::userFromItem($item);
            }),
            'comments' => collect($this['comments'])->map(function ($item) {
                $item['user'] = KipResource::userFromItem($item['user']);
                return $item;
            }),
        ];
    }
}
