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

}
