<?php
/**
 * Transit DB itservice->transit_skud_events
 * Desc: События СКУД
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit;

use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransitSkudEvent extends TransitionModel
{
    protected $table = 'transit_skud_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID',
        'userID',
        'ID_PhPerson',
        'type',
        'device',
        'direction',
        'time'
    ];

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_person', 'ID_PhPerson');
    }

    /**
     * Get PhPerson Data from transit_1c_PhPerson (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phPerson() : BelongsTo
    {
        return $this->belongsTo(Transit1cPhPerson::class, 'id', 'ID_PhPerson');
    }

    /**
     * Get Department Data from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo(Transit1cDepartment::class, 'id_chief', 'ID_PhPerson');
    }

    /**
     * Get Employee Data from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Transit1cEmployee::class, 'id_phperson', 'ID_PhPerson');
    }

    /**
     * Get Device Data from spr_dev (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device() : BelongsTo
    {
        return $this->belongsTo(SprDev::class, 'device');
    }
}
