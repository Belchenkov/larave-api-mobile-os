<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\PassRequest;

use App\Actions\BaseAction;
use App\Repositories\PassRequestRepository;
use App\Structure\PassRequest\PassRequest;
use App\Structure\User\UserInterface;

class NewPassRequestAction extends BaseAction
{

    private $passRequestRepository;

    public function __construct()
    {
        $this->passRequestRepository = new PassRequestRepository();
    }

    /**
     * @param UserInterface $user
     * @param PassRequest $structure
     * @return $this
     */
    public function execute(UserInterface $user, PassRequest $structure)
    {
        $pass = $this->passRequestRepository->createPassRequest($user, $structure);
        $this->setActionResult($pass);

        return $this;
    }
}
