<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Tableau extends LocalDBModel
{
    use MillesecondFixTrait, Notifiable;

    protected $table = 'tableau';

    protected $fillable = [
        'title', 'tableau_url'
    ];

    public function users() : HasMany
    {
        return $this->hasMany(TableauUsers::class, 'tableau_id', 'id');
    }
}
