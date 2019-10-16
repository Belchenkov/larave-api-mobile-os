<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;

class News extends LocalDBModel
{
    use MillesecondFixTrait;

    protected $table = 'news';

    protected $fillable = [
        'title', 'content', 'publish'
    ];
}
