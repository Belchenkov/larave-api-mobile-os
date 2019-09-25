<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25/09/2019
 */

namespace App\Services\MsSQL;


trait AttributeHelperTrait
{
    public function getModelAttribute($keys, $default = null)
    {
        $keys = explode('.', $keys);
        $attr = $this;

        foreach ($keys as $key) {
            if (!$attr = $attr->{$key} ?? $default) {
                $attr = $default;
                break;
            }
        }

        return $attr;
    }
}
