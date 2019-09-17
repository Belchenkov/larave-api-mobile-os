<?php

/**
 * Transit DB itservice->transit_1c_employee_chief
 * Desc: функциональные руководители
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit\_1C;

use App\Models\Transit\CoreUserData;
use App\Models\Transit\TransitionModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transit1cEmployeeChief extends TransitionModel
{
    protected $table = 'transit_1c_employee_chief';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tab_no_employee',
        'base',
        'dt',
        'tab_no_chief'
    ];

    /**
     * Get Employee from transit_1c_employee (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employeeChiefInfo() : HasOne
    {
        return $this->hasOne(Transit1cEmployee::class, 'tab_no', 'tab_no_chief');
    }

    /**
     * Get Employee Department from transit_1c_department (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function employeeChiefDepartment() : HasOne
    {
        return $this->hasOne(Transit1cDepartment::class, 'tab_no_chief', 'tab_no_chief');
    }

    /**
     * Get Core User data from ITS.Core_UserData (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function coreUserData() : HasOne
    {
        return $this->hasOne(CoreUserData::class, 'tab_no', 'tab_no_employee');
    }


    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'tab_no', 'tab_no_employee');
    }
}
