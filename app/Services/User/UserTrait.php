<?php
/**
 * Created by black40x@yandex.ru
 * Date: 24/09/2019
 */

namespace App\Services\User;


use App\Repositories\User\StatisticVisitRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

trait UserTrait
{

    use UserAvatarTrait;
    use UserInformationTrait;

}
