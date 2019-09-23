<?php
/**
 * Transit DB itservice->spr_dev
 * Desc: Справочник девайсов
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit;

use Illuminate\Database\Eloquent\Relations\HasMany;

class SprDev extends TransitionModel
{
    protected $table = 'spr_dev';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'dev_name',
        'ID_PhPerson',
        'office_name',
        'office_code'
    ];

    /**
     * Get Skud Events Data from transit_skud_events (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function skudEvents() : HasMany
    {
        return $this->hasMany(TransitSkudEvent::class, 'device');
    }
}
