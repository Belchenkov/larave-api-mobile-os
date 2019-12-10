<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class TableauUsers extends LocalDBModel
{
    use MillesecondFixTrait, Notifiable;

    protected $table = 'tableau_users';
    public $timestamps = false;

    protected $fillable = [
        'id_phperson'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_phperson', 'id_person');
    }
}
