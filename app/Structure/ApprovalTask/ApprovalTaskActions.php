<?php
/**
 * Created by black40x@yandex.ru
 * Date: 09/10/2019
 */

namespace App\Structure\ApprovalTask;


class ApprovalTaskActions
{

    const TASK_CAN_EDIT = 0;
    const TASK_ACCEPT = 1;
    const TASK_CANCEL = 2;
    const TASK_APPLY = 4;
    const TASK_APPLY_WITH_COMMENT = 3;

    private $defaultStruct = [
        'actions' => [self::TASK_ACCEPT, self::TASK_CANCEL],
        'buttons' => [
            [
                'caption' => 'Выполнено',
                'action' => self::TASK_ACCEPT
            ],
            [
                'caption' => 'Отклонено',
                'action' => self::TASK_CANCEL
            ],
        ]
    ];

    private $statusStruct = [
        [
            'name' => 'Ознакомиться',
            'actions' => [self::TASK_ACCEPT],
            'buttons' => [
                [
                    'caption' => 'Ознакомлен',
                    'action' => self::TASK_ACCEPT
                ],
            ]
        ],
        [
            'name' => 'Исполнить',
            'actions' => [self::TASK_ACCEPT],
            'buttons' => [
                [
                    'caption' => 'Выполнено',
                    'action' => self::TASK_ACCEPT
                ],
            ]
        ],
        [
            'name' => 'Согласовать',
            'actions' => [self::TASK_CANCEL, self::TASK_APPLY],
            'buttons' => [
                [
                    'caption' => 'Согласовать',
                    'action' => self::TASK_APPLY
                ],
                [
                    'caption' => 'Отклонить',
                    'action' => self::TASK_CANCEL
                ],
            ]
        ],
        [
            'name' => 'Проверить исполнение',
            'actions' => [self::TASK_ACCEPT],
            'buttons' => [
                [
                    'caption' => 'Выполнено',
                    'action' => self::TASK_ACCEPT
                ],
            ]
        ],
        [
            'name' => 'Утвердить',
            'actions' => [self::TASK_CANCEL, self::TASK_APPLY],
            'buttons' => [
                [
                    'caption' => 'Утверждено',
                    'action' => self::TASK_APPLY
                ],
                [
                    'caption' => 'Не утверждено',
                    'action' => self::TASK_CANCEL
                ],
            ]
        ],
        [
            'name' => 'Рассмотреть вопрос',
            'actions' => [self::TASK_APPLY],
            'buttons' => [
                [
                    'caption' => 'Выполнено',
                    'action' => self::TASK_ACCEPT
                ],
            ]
        ],
    ];

    /**
     * @param string $type
     * @param string $key
     * @return array
     */
    public function getRelevantActions(string $type, $key = 'actions') : array
    {
        foreach ($this->statusStruct as $status) {
            if (trim($type) == $status['name']) {
                return $status[$key];
            }
        }

        return $this->defaultStruct[$key];
    }

}
