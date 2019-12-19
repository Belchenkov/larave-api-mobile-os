<?php

namespace App\Repositories;

use App\Models\Transit\DoDelegationRight;
use App\Structure\User\UserInterface;
use Carbon\Carbon;

/**
 * Class DelegationRightsRepository
 * @package App\Repositories
 * Делегирование полномочий
 */
class DelegationRightsRepository
{
    /**
     * @param UserInterface $user
     * @return \Illuminate\Database\Eloquent\Collection
     * Get Delegation Executors
     */
    public function getExecutors(UserInterface $user)
    {
        return $user->delegationExecutors()
            ->with([
                'chiefDelegation',
                'executorDelegation'
            ])
            ->orderBy('dt', 'DESC');
    }

    /**
     * @param UserInterface $user
     * @param $delegation_id
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     * Get Delegation Right by id
     */
    public function getDelegationById(UserInterface $user, $delegation_id)
    {
        return $user
            ->delegationExecutors()
            ->with([
                'chiefDelegation',
                'executorDelegation'
            ])
            ->where('KeyRow', $delegation_id)
            ->first();
    }

    /**
     * @param UserInterface $user
     * @param string $on_whom
     * @param string $period_start
     * @param string $period_end
     * @param int $is_active
     * @return bool
     */
    public function createDelegationRight(
        UserInterface $user,
        string $on_whom,
        string $period_start,
        string $period_end,
        int $is_active
    )
    {
        DoDelegationRight::create([
            'OnWhom' => $on_whom,
            'FromWhom' => $user->user_ad_login,
            'PeriodStart' => Carbon::parse($period_start)->format('Y-m-d H:i:s'),
            'PeriodEnd' => Carbon::parse($period_end)->format('Y-m-d H:i:s'),
            'is_active' => $is_active,
            'base' => 'Mobapp',
            'dt' => Carbon::now()->format('Y-m-d H:i:s'),
            'Name_source' => 'Mobapp'
        ]);

        return true;
    }
}
