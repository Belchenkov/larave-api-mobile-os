<?php
/**
 * Transit DB itservice->do_session_pass
 * Desc: Заявки - основная информация
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoSessionPass extends TransitionModel
{
    protected $table = 'do_sessions_pass';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'id_doc_1C',
        'NumRow',
        'Date_start',
        'Date_end',
        'visitor',
        'employee',
        'description',
        'id',
        'annotation'
    ];

    /**
     * Get DoSessionHeader Data from do_sessions_header (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function doSessionHeader() : BelongsTo
    {
        return $this->belongsTo(DoSessionHeader::class, 'id');
    }
}
