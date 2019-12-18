<?php

namespace App\Repositories;

use App\Models\User;
use App\Structure\User\UserInterface;

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
     * @param array $on_whom
     * @param string $period_start
     * @param string $period_end
     * @param int $is_active
     * @return bool
     */
    public function createDelegationRight(
        UserInterface $user,
        array $on_whom,
        string $period_start,
        string $period_end,
        int $is_active
    ) {
        //dd($user);
        return true;
    }
}
