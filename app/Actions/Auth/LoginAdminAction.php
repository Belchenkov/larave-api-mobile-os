<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/09/2019
 */

namespace App\Actions\Auth;

use App\Actions\BaseAction;
use App\Exceptions\Api\ApiException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginAdminAction extends BaseAction
{
    /**
     * @var User
     */
    private $user = null;

    public function execute($email, $password)
    {
        if ($user = User::where('email', $email)->first()) {
            if ($user->is_admin && Hash::check($password, $user->password)) {
                $this->user = $user;
                $jwtToken = $this->user->generateJwt();
                $this->user->save();
                $this->setActionResult($jwtToken);
            } else
                throw new ApiException(422, 'Invalid password');
        } else {
            throw new ApiException(422, 'User not found');
        }

        return $this;
    }
}
