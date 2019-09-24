<?php
/**
 * Mobile DB
 * Desc: JWT token
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserJwtToken
 * @package App\Models
 * User JWT Tokens
 */
class UserJwtToken extends Model
{

    protected $table = 'user_jwt_tokens';
    //protected $dateFormat = 'Y-m-d H:i:s';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'access_token', 'refresh_token', 'user_id', 'access_expire_at', 'refresh_expire_at',
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
