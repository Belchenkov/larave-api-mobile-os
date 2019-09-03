<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserToken
 * @package App\Models
 * Users Tokens(PIN_CODES)
 */
class UserToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'pin_code',
    ];

    /**
     * Get User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
