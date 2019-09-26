<?php
/**
 * Transit DB itservice->transit_1c_link_department
 * Desc: Cоответствие подразделений орг.структуры и подразделений организаций
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit\_1C;

use App\Models\Transit\TransitionModel;

class Transit1cLinkDepartment extends TransitionModel
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
        'Code1cDepartmentOrganisation'
    ];
}
