<?php
/**
 * Created by black40x@yandex.ru
 * Date: 04/10/2019
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class LocalDBModel extends Model
{
    protected $connection = 'sqlsrv';
}
