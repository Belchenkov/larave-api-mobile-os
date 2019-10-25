<?php
/**
 * Created by black40x@yandex.ru
 * Date: 24/10/2019
 */

namespace App\Services;

use Spatie\Cors\CorsProfile\DefaultProfile;

class CorsProfile extends DefaultProfile
{

    public function isAllowed(): bool
    {
        if (!config('app.debug'))
            return false;

        return parent::isAllowed();
    }


}
