<?php
/**
 * Mobile DB
 * Desc: JWT token
 */

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserJwtToken
 * @package App\Models
 * User JWT Tokens
 */
class UserJwtToken extends LocalDBModel
{
    use MillesecondFixTrait;

    protected $table = 'user_jwt_tokens';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_token', 'refresh_token', 'user_id', 'access_expire_at', 'refresh_expire_at', 'user_agent', 'ip_address',
    ];

    /**
     * Get User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
