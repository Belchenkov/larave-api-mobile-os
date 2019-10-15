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
            'files' => collect($xml->xpath('Файлы'))->map(function ($item) {
                $elem = $item->xpath('ДанныеФайла');
                if (!isset($elem[0])) return false;

                return collect([
                    'file_id' => (string) $elem[0]['Ссылка'],
                    'file_name' => (string) $elem[0]['Название']
                ]);
            })
        ]);
    }

}
