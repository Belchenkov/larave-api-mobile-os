<?php

namespace App\Models;

use App\Models\Transit\DoTask;
use App\Services\MsSQL\OriginalColumns;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventHandle extends LocalDBModel
{
    use OriginalColumns;

    private $originalColumns = ['event_id'];
    protected $table = 'event_handle';

    const HANDLE_TYPE_DOTASK = 1;
    const HANDLE_TYPE_VISITOR = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_id',
        'handle_type'
    ];

    /**
     * Get Executors Tasks Data from do_tasks (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doTask() : BelongsTo
    {
        return $this->belongsTo(DoTask::class, 'event_id', 'id_task_1C');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'event_id', 'id-person');
    }
}
