<?php
/**
 * Mobile DB
 * Desc: Send Request to mail
 */

namespace App\Models;

use App\Services\MsSQL\MillesecondFixTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestSupport extends LocalDBModel
{
    use MillesecondFixTrait;

    protected $table = 'request_support';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type_request',
        'comment',
        'from',
        'is_send',
        'to'
    ];

    const REQUEST_TYPE_SUPPORT = 1; // Служба Технической поддержки
    const REQUEST_TYPE_ACHO = 2; // Служба АХО
    const REQUEST_TYPE_OPERATION_SERVICE = 3; // Служба Эксплуатации

    const REQUEST_TYPE_SUPPORT_MAIL = '0000@gk-osnova.ru';
    const REQUEST_TYPE_ACHO_MAIL = '9999@gk-osnova.ru';
    const REQUEST_TYPE_OPERATION_SERVICE_MAIL = '8888@gk-osnova.ru';

    /**
     * Get User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
