<?php


namespace App\Repositories;


use App\Models\RequestSupport;
use App\Models\User;

class SupportRequestRepository
{
    /**
     * @param User $user
     * @param $type_request
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getSupportRequests(User $user, $type_request)
    {
        return $user->requestSupport()
            ->where('type_request', $type_request)
            ->orderBy('id', 'DESC');
    }

    /**
     * @param User $user
     * @param $request_id
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getSupportRequest(User $user, $request_id)
    {
        return $user->requestSupport()->where('id', $request_id)->first();
    }

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
