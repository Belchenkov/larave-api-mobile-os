<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\ApprovalTask;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\Transit\DoTask;
use App\Repositories\ApprovalTaskRepository;
use App\Repositories\BadgesRepository;
use App\Structure\ApprovalTask\ApprovalTaskActions;
use App\Structure\User\UserInterface;

class UpdateTaskAction extends BaseAction
{

    private $approvalTaskRepository;
    private $badgesRepository;

    public function __construct()
    {
        $this->approvalTaskRepository = new ApprovalTaskRepository();
        $this->badgesRepository = new BadgesRepository();
    }

    /**
     * @param UserInterface $user
     * @param DoTask $task
     * @param $status
     * @param $comment
     * @return $this
     */
    public function execute(UserInterface $user, DoTask $task, $status, $comment)
    {
        if ($task->task_status != ApprovalTaskActions::TASK_CAN_EDIT)
            throw new ApiException(422, 'User task cant be updated');

        // ToDo - validate by task type!!!! IMPORTANT type_descriptions
        if (!in_array($status, $task->getRelevantActions()))
            throw new ApiException(422, 'Invalid task status');

        $this->approvalTaskRepository->updateUserTask($task, $status, $comment);
        $this->badgesRepository->clearUserBadgesCache($user);

        return $this;
    }

}
