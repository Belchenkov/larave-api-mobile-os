<?php
/**
 * Created by black40x@yandex.ru
 * Date: 26.11.2019
 */

namespace App\Services\Portal\Kip;


class KipStatuses
{
    const STATUS_NEW = 6;
    const STATUS_WAITING_CONTROL = 7;
    const STATUS_IN_WORK = 2;
    const STATUS_DEFER = 8;
    const STATUS_COMPLETED = 9;
    const STATUS_QUEUE = 10;

    public $statuses = [
        self::STATUS_NEW => 'Новая',
        self::STATUS_IN_WORK => 'Выполняется',
        self::STATUS_WAITING_CONTROL => 'Ожидает контроля',
        self::STATUS_COMPLETED => 'Завершено',
        self::STATUS_DEFER => 'Отложено',
        self::STATUS_QUEUE => 'В очереди',
    ];
}
