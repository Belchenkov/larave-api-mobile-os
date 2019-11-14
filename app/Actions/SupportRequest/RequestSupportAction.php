<?php

namespace App\Actions\SupportRequest;

use App\Actions\BaseAction;
use App\Models\RequestSupport;
use App\Notifications\Support\SupportRequestNotification;
use App\Repositories\SupportRequestRepository;
use App\Structure\User\UserInterface;

class RequestSupportAction extends BaseAction
{

    private $supportRequestRepository;

    public function __construct(SupportRequestRepository $supportRequestRepository)
    {
        $this->supportRequestRepository = $supportRequestRepository;
    }

    /**
     * @param UserInterface $user
     * @param $comment
     * @param $type_request
     * @return $this
     */
    public function execute(UserInterface $user, $comment, $type_request)
    {
        $to = '';

        switch ($type_request) {
            case RequestSupport::REQUEST_TYPE_SUPPORT:
                $to = RequestSupport::REQUEST_TYPE_SUPPORT_MAIL;
                break;
            case RequestSupport::REQUEST_TYPE_ACHO:
                $to = RequestSupport::REQUEST_TYPE_ACHO_MAIL;
                break;
            case RequestSupport::REQUEST_TYPE_OPERATION_SERVICE:
                $to = RequestSupport::REQUEST_TYPE_OPERATION_SERVICE_MAIL;
                break;
        }

        $mail_request = $this->supportRequestRepository->saveMail(
            $user->user->id,
            $user->email,
            $to,
            $type_request,
            $comment
        );

        $user->user->notify(new SupportRequestNotification(
            $to,
            $comment,
            $user,
            $mail_request
        ));

        $this->setActionResult($mail_request);

        return $this;
    }
}
