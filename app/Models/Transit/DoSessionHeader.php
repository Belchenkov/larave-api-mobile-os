<?php
/**
 * Transit DB itservice->do_session_header
 * Desc: Заявки - заголовки
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoSessionHeader extends TransitionModel
{
    protected $table = 'do_sessions_header';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'Name_source',
        'Name_1C',
        'id_doc_source',
        'id_doc_1C',
        'date_1С',
        'amount',
        'descriptions',
        'number_1С',
        'curr',
        'text_doc',
        'project_id_1c',
        'object_id_1c',
        'organisation_id_1c',
        'link_1С',
        'link_source',
        'employee',
        'employee_prepare',
        'status',
        'offices_id',
        'error_message_sync',
    ];

    /**
     * Get DoSessionPass Data from do_sessions_pass (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doSessionPass() : BelongsTo
    {
        return $this->belongsTo(DoSessionPass::class, 'id');
    }

    /**
     * Get SprOffice Data from transit_spr_offices (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sprOffice() : BelongsTo
    {
        return $this->belongsTo(TransitSprOffice::class, 'offices_id', 'id_1c');
    }
}
