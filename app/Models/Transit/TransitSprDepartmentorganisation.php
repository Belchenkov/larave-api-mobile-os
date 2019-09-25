<?php
/**
 * Transit DB itservice->transit_spr_departmentorganisation
 * Desc: Подразделении организации
 */
namespace App\Models\Transit;

use App\Models\Transit\_1C\Transit1cEmployee;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransitSprDepartmentorganisation extends TransitionModel
{
    protected $table = 'transit_spr_departmentorganisation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'Base',
        'dt',
        'Guid1c',
        'Guid1cParent',
        'Code1C',
        'Code1CParent',
        'GuidChief1C',
        'Name',
        'FullName',
        'Order1C',
        'isDelete',
        'Guid1cOrganisation',
        'Code1cOrganisation',
        'INNOrganisation',
        'KPPOrganisation',
        'snils_chief',
        'Code1cOrgStructure',
        'level'
    ];

    /**
     * Get Employee Data from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function employee() : BelongsTo
    {
        return $this->belongsTo(Transit1cEmployee::class, 'Guid1c','department_guid');
    }
}
