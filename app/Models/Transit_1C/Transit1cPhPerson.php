<?php

namespace App\Models\Transit_1C;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transit1cPhPerson extends TransitionModel
{
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

    /**
     * Get Core User Data
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function coreUserData() : BelongsTo
    {
        return $this->belongsTo(CoreUserData::class, 'id_phperson');
    }
}
