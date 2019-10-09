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
     * Get User Data (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'id_phperson');
    }
}
