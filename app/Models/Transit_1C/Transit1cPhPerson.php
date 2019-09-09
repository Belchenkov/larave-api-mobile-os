<?php

namespace App\Models\Transit_1C;

use App\Models\User\User\CoreUserData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transit1cPhPerson extends Model
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