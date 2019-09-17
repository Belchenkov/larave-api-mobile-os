<?php
/**
 * Transit DB itservice->transit_1c_calender
 * Desc: Производственный календарь
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use Illuminate\Database\Eloquent\Model;

class Transit1cCalendar extends Model
{
    protected $table = 'transit_1c_department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dt',
        'dt_name',
        'year'
    ];
}
