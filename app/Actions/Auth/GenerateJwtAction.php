<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Auth;


use App\Actions\BaseAction;
use App\Models\User;
use App\Models\UserJwtToken;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class GenerateJwtAction extends BaseAction
{

    private $access_token = null;
    private $access_token_expire_at = null;
    private $refresh_token = null;
    private $refresh_token_expire_at = null;

    public function execute(User $user)
    {
        do {
            $this->access_token = str_random(60);
        } while (UserJwtToken::where('access_token', $this->access_token)->exists());

        do {
            $this->refresh_token = str_random(60);
        } while (UserJwtToken::where('refresh_token', $this->refresh_token)->exists());

        $user->jwtToken()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'access_expire_at' => $this->access_token_expire_at = Carbon::now()->addHours(6),
                'refresh_expire_at' => $this->refresh_token_expire_at = Carbon::now()->addDays(3),
            ]
        );

        return $this;
    }

}
