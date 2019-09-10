<?php
/**
 * Mobile DB
 * Desc: Callback от интранет портала при регистрации сотрудника
 */

namespace App\Models;

use App\Models\Transit\_1C\Transit1cPhPerson;
use App\Services\Auth\JwtAuthenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, JwtAuthenticatable;

    protected $table = 'users';

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
    public function pinCode() : HasOne
    {
        return $this->hasOne(UserPinCode::class, 'user_id');
    }

    /**
     * Get User JWT Token
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function jwtToken() : HasOne
    {
        return $this->hasOne(UserJwtToken::class, 'user_id');
    }

    /**
     * Get User Data (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function transitPhPerson() : BelongsTo
    {
        return $this->hasOne(Transit1cPhPerson::class, 'id_phperson');
    }

}
