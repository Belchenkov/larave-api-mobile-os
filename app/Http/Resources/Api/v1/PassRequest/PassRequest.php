<?php

namespace App\Http\Resources\Api\v1\PassRequest;

use App\Http\Resources\JsonApiResourse;
use Carbon\Carbon;

class PassRequest extends JsonApiResourse
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
            'id' => $this->id,
            'id_doc' => $this->id_doc_1C,
            'name' => $this->Name_1C,
            'description' => $this->text_doc,
            'pass_type' => $this->descriptions,
            'status' => $this->status,
            'employee' => $this->employee,
            'error_message' => $this->error_message_sync,
            'office' => $this->relationLoaded('sprOffice') ? [
                'id' => $this->sprOffice->id_1c,
                'code' => $this->sprOffice->Code1C,
                'name' => $this->sprOffice->Name,
            ] : null,
            'visitors' => $this->relationLoaded('doSessionPass') ? $this->doSessionPass->map(
                    function($item) {
                        return [
                            'visitor' => $item->visitor,
                            'description' => $item->description,
                            'annotation' => $item->annotation,
                            'date_start' => Carbon::parse($item->Date_start),
                            'date_end' => Carbon::parse($item->Date_end),
                        ];
                    }
                ) : [],
            'created_at' => Carbon::parse($this->date_1С),
        ];
    }
}
