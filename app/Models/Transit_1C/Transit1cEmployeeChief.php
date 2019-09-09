<?php

namespace App\Models\Transit_1C;

use Illuminate\Database\Eloquent\Model;

class Transit1cEmployeeChief extends Model
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
}
