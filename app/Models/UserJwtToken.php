<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserJwtToken
 * @package App\Models
 *  User JWT Tokens
 */
class UserJwtToken extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_token', 'refresh_token', 'user_id', 'expires_in',
    ];
}
