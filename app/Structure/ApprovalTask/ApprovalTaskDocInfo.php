<?php
/**
 * Created by black40x@yandex.ru
 * Date: 09/10/2019
 */

namespace App\Structure\ApprovalTask;


use Illuminate\Support\Collection;

class ApprovalTaskDocInfo
{

    private $xml;

    public function __construct($xml)
    {
        $this->xml = $xml;
    }

    /**
     * @return Collection|null
     */
    public function getDocInfo() : ?Collection
    {
        if (!$this->xml) return null;

        $xml = simplexml_load_string($this->xml);

        return collect([
            'theme' => (string) $xml['Тема'],
            'organization' => (string) $xml['Организация'],
            'partner' => (string) $xml['Контрагент'],
            'doc_no' => (string) $xml['Номер'],
            'date' => (string) $xml['Дата'],
            'cost' => (string) $xml['Сумма'],
            'executor' => (string) $xml['Ответственный'],
            'project' => (string) $xml['Проект'],
            'article' => (string) $xml['СтатьяДДС'],
            'files' => collect($xml->xpath('Файлы/ДанныеФайла'))->map(function ($item) {
                return collect([
                    'file_id' => (string) $item['Ссылка'],
                    'file_name' => (string) $item['Название'] . (isset($item['Расширение']) ? '.'.$item['Расширение'] : ''),
                    'file_ext' => isset($item['Расширение']) ? $item['Расширение'].'' : null,
                ]);
            }),
            'visitors' => collect($xml->xpath('СписокДоступ/СписокПосетителей'))->map(function ($item) {
                return collect([
                    'start_date' => (string) $item[0]['ДатаНачала'],
                    'end_date' => (string) $item[0]['ДатаОкончания'],
                    'visitor' => (string) $item[0]['Посетитель'],
                    'to_employee' => (string) $item[0]['ККомуПрибыл'],
                    'visit_point' => (string) $item[0]['ЦельВизита'],
                    'comment' => (string) $item[0]['Комме нтарий']
                ]);
            })
        ]);
    }

}
