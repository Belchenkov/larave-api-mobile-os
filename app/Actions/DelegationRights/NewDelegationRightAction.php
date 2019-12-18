<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\DelegationRights;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\EventHandle;
use App\Models\Transit\DoTask;
use App\Notifications\ApprovalTask\NewTaskNotification;
use App\Repositories\BadgesRepository;
use App\Repositories\DelegationRightsRepository;
use App\Structure\User\UserInterface;

class NewDelegationRightAction extends BaseAction
{
    private $delegationRightsRepository;

    public function __construct()
    {
        $this->delegationRightsRepository = new DelegationRightsRepository();
    }

    /**
     * @param UserInterface $user
     * @param array $on_whom
     * @param string $period_start
     * @param string $period_end
     * @param int $is_active
     * @return $this
     * Execute new delegation right
     */
    public function execute(UserInterface $user, array $on_whom, string $period_start, string $period_end, int $is_active)
    {
        $this->delegationRightsRepository->createDelegationRight(
            $user,
            $on_whom,
            $period_start,
            $period_end,
            $is_active
        );

        return $this;
    }
}
