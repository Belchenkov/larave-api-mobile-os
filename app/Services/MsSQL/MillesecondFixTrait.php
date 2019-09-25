<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25/09/2019
 */

namespace App\Services\MsSQL;

trait MillesecondFixTrait
{

    public function getDateFormat()
    {
        if ($this->getOriginal('created_at') && strpos($this->getOriginal('created_at'), '.')) {
            return 'Y-m-d H:i:s.v';
        }
        return 'Y-m-d H:i:s';
    }

}
