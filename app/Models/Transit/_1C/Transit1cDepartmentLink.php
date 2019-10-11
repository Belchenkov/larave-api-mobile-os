<?php

/**
 * Transit DB itservice->transit_1c_department
 * Desc: Подразделения структуры предприятия
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transit1cDepartmentLink extends TransitionModel
{
    protected $table = 'transit_1c_link_department';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Guid1cDepartment',
        'Code1cDepartment',
        'Guid1cDepartmentOrganisation',
        'Code1cDepartmentOrganisation',
        'Base',
        'dt'
    ];

    /**
     * Get Department from transit_1c_department (Transit DB)
     * @return BelongsTo
     */
    public function department() : BelongsTo
    {
        return $this->belongsTo(Transit1cDepartment::class, 'Guid1cDepartment', 'id_1c');
    }
}
