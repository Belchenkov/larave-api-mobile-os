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
}
