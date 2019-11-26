<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25.11.2019
 */

namespace App\Structure;


class CustomStdObject
{
    public function __call($method, $args)
    {
        if(is_callable(array($this, $method))) {
            return call_user_func_array($this->$method, $args);
        }
    }
}
