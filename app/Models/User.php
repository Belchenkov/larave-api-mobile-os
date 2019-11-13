<?php
/**
 * Mobile DB
 * Desc: Callback от интранет портала при регистрации сотрудника
 */

namespace App\Models;

use App\Models\Transit\Portal\ForUser;
use App\Services\Auth\JwtAuthenticatable;
use App\Services\MsSQL\AttributeHelperTrait;
use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, JwtAuthenticatable, MillesecondFixTrait, AttributeHelperTrait;

    protected $table = 'users';
    protected $connection = 'sqlsrv';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ad_login', 'tab_no', 'id_person', 'email'
    ];

    /**
     * Get User Token(PIN) from user_tokens (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function pinCode() : HasOne
    {
        return $this->hasOne(UserPinCode::class, 'user_id');
    }

    /**
     * Get User JWT Token from user_jwt_tokens (Mobile DB)
     * @return HasMany
     */
    public function jwtToken() : HasMany
    {
        return $this->hasMany(UserJwtToken::class, 'user_id');
    }

    /**
     * Get Request Mail Info from request_mail (Mobile DB)
     * @return HasMany
     */
    public function requestMail() : HasMany
    {
        return $this->hasMany(RequestSupport::class, 'user_id');
    }

     /**
     * Get User Devices from user_devices (Mobile DB)
     * @return HasMany
     */
    public function devices() : HasMany
    {
        return $this->hasMany(UserDevice::class, 'user_id');
    }

    public function mailing() : HasMany
    {
        return $this->hasMany(Mailing::class);
    }

    /**
     * Get User Info from for_users (Transit DB)
     * @return HasOne
     */
    public function portalUser() : HasOne
    {
        return $this->hasOne(ForUser::class, 'id_phperson', 'id_person');
    }

    public function handleEvent() : HasOne
    {
        return $this->hasOne(EventHandle::class, 'event_id', 'id_person');
    }


}
