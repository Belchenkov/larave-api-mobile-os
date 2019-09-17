<?php

/**
 * Transit DB itservice->transit_1c_schedule_employee
 * Desc: привязка сотрудников к графикам
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;
use App\Models\Transit\TransitSprOffice;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transit1cScheduleEmployee extends TransitionModel
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

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Employee Data from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Transit1cEmployee::class, 'tab_no', 'tab_no');
    }

    /**
     * Get Department Data from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo(Transit1cDepartment::class, 'tab_no_chief', 'tab_no');
    }
}
