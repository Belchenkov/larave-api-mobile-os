<?php
/**
 * Transit DB itservice->do_delegation_rights
 * Desc: Делегирование полномочий
 * Источник: 1С ЗУП
 */
namespace App\Models\Transit;

use App\Models\Transit\Portal\ForUser;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DoDelegationRight extends TransitionModel
{
    protected $table = 'do_delegation_rights';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'OnWhom',
        'FromWhom',
        'PeriodStart',
        'PeriodEnd',
        'is_active',
        'base',
        'Name_source',
        'dt'
    ];

    /**
     * Get Chief Delegation Data from for_users (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chiefDelegation() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'FromWhom', 'user_ad_login');
    }

    /**
     * Get Executor Delegation Data from for_users (Transit DB)
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function executorDelegation() : BelongsTo
    {
        return $this->belongsTo(ForUser::class, 'OnWhom', 'user_ad_login');
    }
}
