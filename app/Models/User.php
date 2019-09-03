<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_login', 'tab_no', 'id_person',
    ];


    /**
     * Get User Token(PIN)
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userToken()
    {
        return $this->hasOne('App\Models\UserToken', 'user_id');
    }

    /**
     * Get User JWT Token
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function userJwtToken()
    {
        return $this->hasOne('App\Models\UserJwtToken', 'user_id');
    }
}
