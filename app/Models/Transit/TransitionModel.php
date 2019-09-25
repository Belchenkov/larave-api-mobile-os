<?php
/**
 * Created by black40x@yandex.ru
 * Date: 09/09/2019
 */

namespace App\Models\Transit;

use App\Services\MsSQL\AttributeHelperTrait;
use Illuminate\Database\Eloquent\Model;

class TransitionModel extends Model
{
    use AttributeHelperTrait;

    protected $connection = 'sqlsrv_transition';
    protected $dateFormat = 'Y-m-d H:i:s';

}
