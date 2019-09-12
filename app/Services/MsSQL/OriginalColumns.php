<?php
/**
 * Created by black40x@yandex.ru
 * Date: 12/09/2019
 */

namespace App\Services\MsSQL;


trait OriginalColumns
{

    public function __get($key)
    {
        if (isset($this->originalColumns) && in_array($key, $this->originalColumns)) {
            return $this->getOriginal($key);
        }

        return $this->getAttribute($key);
    }
}
