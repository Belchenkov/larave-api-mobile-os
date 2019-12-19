<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\DelegationRights;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Repositories\DelegationRightsRepository;
use App\Structure\User\UserInterface;

class UpdateDelegationRightAction extends BaseAction
{
    private $delegationRightsRepository;

    public function __construct()
    {
        $this->delegationRightsRepository = new DelegationRightsRepository();
    }

    /**
     * @param UserInterface $user
     * @param int $delegation_id
     * @param int $is_active
     * @return $this
     * Execute update delegation right
     */
    public function execute(UserInterface $user, int $delegation_id, int $is_active)
    {
        if (!$delegation = $this->delegationRightsRepository->getDelegationById($user, $delegation_id)) {
            throw new ApiException(404, 'Delegation right not found');
        }

        $delegation->setPrimaryKey()->update(['is_active' => $is_active]);

        return $this;
    }
}
