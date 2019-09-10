<?php

/**
 * Transit DB itservice->transit_1c_schedule
 * Desc: Графики работы
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use Illuminate\Database\Eloquent\Model;

class Transit1CSchedule extends Model
{
    protected $table = 'transit_1c_schedule';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'weekday',
        'schedule_name',
        'date_in',
        'date_out',
        'dt',
        'Dinner',
        'base'
    ];
}
