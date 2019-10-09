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
     * Get User Token(PIN)
     * @return \Illuminate\Database\Eloquent\Relations\hasOne
     */
    public function pinCode() : HasOne
    {
        return $this->hasOne(UserPinCode::class, 'user_id');
    }

    /**
     * Get User JWT Token
     * @return HasMany
     */
    public function jwtToken() : HasMany
    {
        return $this->hasMany(UserJwtToken::class, 'user_id');
    }

     /**
     * Get User Devices
     * @return HasMany
     */
    public function devices() : HasMany
    {
        return $this->hasMany(UserDevice::class, 'user_id');
    }

    /**
     * @return HasOne
     */
    public function portalUser() : HasOne
    {
        return $this->hasOne(ForUser::class, 'employee_external_id', 'tab_no');
    }

}
