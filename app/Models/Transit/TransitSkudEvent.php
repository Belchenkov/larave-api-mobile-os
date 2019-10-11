<?php
/**
 * Transit DB itservice->transit_skud_events
 * Desc: События СКУД
 * Источник: 1С ЗУП
 */

namespace App\Models\Transit;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransitSkudEvent extends TransitionModel
{
    protected $table = 'transit_skud_events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ID',
        'userID',
        'ID_PhPerson',
        'type',
        'device',
        'direction',
        'time'
    ];

    /**
     * Get User Data from users (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'id_person', 'id_phperson');
    }

    /**
     * Get Device Data from spr_dev (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device() : BelongsTo
    {
        return $this->belongsTo(SprDev::class, 'device');
    }
}
