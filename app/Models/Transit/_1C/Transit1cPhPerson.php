<?php

/**
 * Transit DB itservice->transit_1c_PhPerson
 * Desc: физические лица/работники
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\CoreUserData;
use App\Models\Transit\TransitionModel;
use App\Models\Transit\TransitSkudEvent;
use App\Models\Transit\TransitSprOffice;
use App\Models\User;
use App\Services\MsSQL\OriginalColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transit1cPhPerson extends TransitionModel
{
    use OriginalColumns;

    private $originalColumns = ['id'];
    protected $table = 'transit_1c_PhPerson';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'birth_date',
        'SNILS',
        'INN',
        'dt',
        'base',
        'LastName',
        'FirstName',
        'MiddleName',
        'passport',
        'gender',
        'phone_internal',
        'phone_mobile',
        'office',
        'room',
        'in_date',
        'out_date',
        'isdelete',
        'PassVidDocument',
        'PassVidDocumentIMNS',
        'PassVidDocumentPFR',
        'PassSerial',
        'PassNumber',
        'PassDate',
        'PaasKem',
        'PassKodPodr',
        'DateRelevance',
        'Code1C',
        'id_office',
        'UpdateNum'
    ];

    protected $hidden = ['UpdateNum'];

    /**
     * Get Core User Data (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coreUserData() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'id_phperson');
    }

    /**
     * Get Skud Events Data from transit_skud_events (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function skudEvents() : HasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'ID_PhPerson');
    }

    /**
     * Get Department Chief from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo(Transit1cDepartment::class, 'id_chief');
    }

    /**
     * Get Employee Data from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Transit1cEmployee::class, 'id_phperson');
    }

    /**
     * Get Office Data from transit_spr_offices (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sprOffice() : BelongsTo
    {
        return $this->belongsTo(TransitSprOffice::class, 'id_Responsible');
    }

    /**
     * Get User Data (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id_person');
    }
}
