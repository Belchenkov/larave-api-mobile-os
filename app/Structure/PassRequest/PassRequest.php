<?php
/**
 * Created by black40x@yandex.ru
 * Date: 30/10/2019
 */

namespace App\Structure\PassRequest;


use Carbon\Carbon;

class PassRequest
{

    public static $types = [
        'Переговоры',
        'Встреча',
        'Совещание',
        'Отдел кадров',
        'Подписание договора',
        'Рабочая встреча',
        'Рабочее совещание',
        'Доставка',
    ];

    private $type;
    private $visitors = [];
    private $phones = [];
    private $date;
    private $comment;
    private $office_id;
    private $employee;

    public function __construct(string $employee, string $type, array $visitors, array $phones, string $comment, Carbon $date, $office_id)
    {
        $this->type = $type;
        $this->visitors = $visitors;
        $this->phones = $phones;
        $this->comment = $comment;
        $this->date = $date;
        $this->office_id = $office_id;
        $this->employee = $employee;
    }

    public function getTypes() : array
    {
        return self::$types;
    }

    public function inTypes(string $type) : bool
    {
        return in_array($type, self::$types);
    }

    public function getTextDoc() : string
    {
        return 'tel: ' . implode(',', $this->phones) . '; ' . $this->comment;
    }

    /**
     * @return string
     */
    public function getEmployee(): string
    {
        return $this->employee;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @return Carbon
     */
    public function getDate(): Carbon
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getOfficeId()
    {
        return $this->office_id;
    }

    /**
     * @return array
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array
     */
    public function getVisitors(): array
    {
        return $this->visitors;
    }
}
