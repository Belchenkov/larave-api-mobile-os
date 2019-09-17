<?php

namespace App\Models\Transit;

use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransitSprOffice extends TransitionModel
{
    protected $table = 'transit_spr_offices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_1c',
        'Code1C',
        'Name',
        'id_1CParent',
        'Code1CParent',
        'NameParent',
        'IsDelete',
        'capacity',
        'IsBooking',
        'Description',
        'id_Responsible',
        'base',
        'dt'
    ];

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_person', 'id_Responsible');
    }

    /**
     * Get PhPerson Data from transit_1c_PhPerson Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function phPerson(): BelongsTo
    {
        return $this->belongsTo(Transit1cPhPerson::class, 'id', 'id_Responsible');
    }

    /**
     * Get Core UserData from ITS.Core_UserData Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function coreUserData(): BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'id_phperson', 'id_Responsible');
    }

    /**
     * Get Department from transit_1c_department Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Transit1cDepartment::class, 'id_chief', 'id_Responsible');
    }

    /**
     * Get Employee from transit_1c_employee Table (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Transit1cEmployee::class, 'id_phperson', 'id_Responsible');
    }
}
