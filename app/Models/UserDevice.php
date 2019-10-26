<?php
/**
 * Mobile DB
 * Desc: Список устройств пользователей
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDevice extends LocalDBModel
{
    protected $table = 'user_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'device_id', 'session_id'
    ];

    /**
     * Get User Data from Users Table (Mobile DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'device_id');
    }
}
