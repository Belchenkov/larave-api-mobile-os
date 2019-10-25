<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Mailing extends LocalDBModel
{
    use MillesecondFixTrait, Notifiable;

    protected $table = 'mailing';

    protected $fillable = [
        'content', 'user_id',
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
