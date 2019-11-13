<?php


namespace App\Repositories;


use App\Models\RequestSupport;

class SupportRequestRepository
{
    /**
     * @param $user_id int
     * @param $from string
     * @param $to string
     * @param $type_request int
     * @param $comment string
     * @return mixed
     */
    public function saveMail($user_id, $from, $to, $type_request, $comment)
    {
        return RequestSupport::create([
            'user_id' => $user_id,
            'from' => $from,
            'to' => $to,
            'type_request' => $type_request,
            'comment' => $comment
        ]);
    }
}
