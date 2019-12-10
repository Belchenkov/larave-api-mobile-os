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

    const INITIATOR = 1;
    const EXECUTOR = 2;

    public $statuses = [
        self::STATUS_NEW => 'Новая',
        self::STATUS_WAITING_CONTROL => 'Ожидает контроля',
        self::STATUS_IN_WORK => 'Выполняется',
        self::STATUS_DEFER => 'Отложено',
        self::STATUS_COMPLETED => 'Завершено',
        self::STATUS_QUEUE => 'В очереди',
    ];

    private $statusStructInitiator = [
        [
            'actions' => [self::STATUS_NEW, self::STATUS_IN_WORK],
            'buttons' => [
                [
                    'caption' => 'Подтвердить выполнение',
                    'action' => self::STATUS_COMPLETED
                ],
                [
                    'caption' => 'Отложить выполнение',
                    'action' => self::STATUS_DEFER
                ],
            ]
        ],
        [
            'actions' => [self::STATUS_DEFER],
            'buttons' => [
                [
                    'caption' => 'Возобновить',
                    'action' => self::STATUS_IN_WORK
                ],
                [
                    'caption' => 'Завершить',
                    'action' => self::STATUS_COMPLETED
                ],
            ]
        ],
        [
            'actions' => [self::STATUS_WAITING_CONTROL],
            'buttons' => [
                [
                    'caption' => 'Подтвердить выполнение',
                    'action' => self::STATUS_COMPLETED
                ],
                [
                    'caption' => 'На доработку',
                    'action' => self::STATUS_IN_WORK
                ],
            ]
        ],
        [
            'actions' => [self::STATUS_COMPLETED],
            'buttons' => [
                [
                    'caption' => 'Возобновить',
                    'action' => self::STATUS_IN_WORK
                ],
            ]
        ]
    ];

    private $statusStructExecutor = [
        [
            'actions' => [self::STATUS_IN_WORK],
            'buttons' => [
                [
                    'caption' => 'Завершить',
                    'action' => self::STATUS_WAITING_CONTROL
                ],
                [
                    'caption' => 'Отложить выполнение',
                    'action' => self::STATUS_DEFER
                ],
            ]
        ],
        [
            'actions' => [self::STATUS_DEFER],
            'buttons' => [
                [
                    'caption' => 'Возобновить',
                    'action' => self::STATUS_IN_WORK
                ],
                [
                    'caption' => 'Завершить',
                    'action' => self::STATUS_WAITING_CONTROL
                ],
            ]
        ],
        [
            'actions' => [self::STATUS_WAITING_CONTROL],
            'buttons' => []
        ],
        [
            'actions' => [self::STATUS_COMPLETED],
            'buttons' => []
        ]
    ];

    private $defaultStruct = [];

    /**
     * @param int $status
     * @return array
     */
    public function getRelevantActions(int $status, $type_user) : array
    {
        $statusStruct = null;

        if ($type_user === self::INITIATOR) {
            $statusStruct = $this->statusStructInitiator;
        } elseif ($type_user === self::EXECUTOR) {
            $statusStruct = $this->statusStructExecutor;
        } else {
            return $this->defaultStruct;
        }

        foreach ($statusStruct as $item) {
            if (in_array($status, $item['actions'])) {
                return $item['buttons'];
            }
        }
        return $this->defaultStruct;
    }
}
