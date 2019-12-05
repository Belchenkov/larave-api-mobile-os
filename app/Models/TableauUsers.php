<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TableauUsers extends Model
{
    use MillesecondFixTrait, Notifiable;

    protected $table = 'tableau_users';
    public $timestamps = false;

    protected $fillable = [
        'id_phperson'
    ];
}
