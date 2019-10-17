<?php

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class News extends LocalDBModel
{
    use MillesecondFixTrait;

    protected $table = 'news';

    protected $fillable = [
        'title', 'content', 'publish'
    ];

    public function images() : MorphMany
    {
        return $this->morphMany(File::class, 'owner');
    }
}
