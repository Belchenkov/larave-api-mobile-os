<?php
/**
 * Mobile DB
 * Desc: User-PINCODE
 */

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class UserToken
 * @package App\Models
 * Users Tokens(PIN_CODES)
 */
class UserPinCode extends Model
{
    use MillesecondFixTrait;

    protected $table = 'user_tokens';

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
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
