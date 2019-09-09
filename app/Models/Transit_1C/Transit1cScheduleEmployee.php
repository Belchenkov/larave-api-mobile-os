<?php

namespace App\Models\Transit_1C;

use Illuminate\Database\Eloquent\Model;

class Transit1cScheduleEmployee extends Model
{
    protected $table = 'transit_1c_schedule_employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no',
        'schedule_name',
        'date_in',
        'date_out',
        'dt',
        'base'
    ];
}
