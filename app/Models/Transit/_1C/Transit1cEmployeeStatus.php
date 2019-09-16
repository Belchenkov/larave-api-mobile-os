<?php
/**
 * Transit DB itservice->transit_1c_employee_status
 * Desc: Состояний рабочего графика
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transit1cEmployeeStatus extends TransitionModel
{
    protected $table = 'transit_1c_employee_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no',
        'date_start',
        'date_end',
        'doc_tp',
        'doc_num',
        'status',
        'doc_dt',
        'dt',
        'base',
        'Guid1C',
        'number_order'
    ];

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no');
    }
}
