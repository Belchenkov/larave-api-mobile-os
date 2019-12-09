<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOption extends LocalDBModel
{
    protected $table = 'user_options';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_phperson', 'kip_global'
    ];

    /**
     * Get User Data from Users Table (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_phperson', 'id_person');
    }
}
