<?php
/**
 * Created by black40x@yandex.ru
 * Date: 01/10/2019
 */

namespace App\Actions\Support;

use App\Actions\BaseAction;
use App\Models\RequestSupport;
use App\Notifications\Support\SupportRequestNotification;
use App\Repositories\SupportRequestRepository;
use App\Structure\User\UserInterface;
use Illuminate\Support\Facades\Auth;

class RequestSupportAction extends BaseAction
{

    private $mailRequestRepository;

    public function __construct(SupportRequestRepository $mailRequestRepository)
    {
        $this->mailRequestRepository = $mailRequestRepository;
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

        Auth::user()->notify(new SupportRequestNotification($to));

        //$mail_request = $this->mailRequestRepository->saveMail(Auth::user()->id, $user->email, $to, $type_request, $comment);

        //$this->setActionResult($pass);

        return $this;
    }
}
