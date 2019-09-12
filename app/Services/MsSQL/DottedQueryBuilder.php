<?php
/**
 * Created by black40x@yandex.ru
 * Date: 12/09/2019
 */

namespace App\Services\MsSQL;


use Illuminate\Database\Query\Builder;

class DottedQueryBuilder extends Builder
{

    /**
     * Get the SQL representation of the query.
     *
     * @return string
     */
    public function toSql()
    {
        $sql = $this->grammar->compileSelect($this);
        $table = explode('.', $this->from);
        if (count($table) > 0) {
            $table = explode('.', $this->from);
            $table = implode('].[', $table);
            $sql = str_replace('[' . $table . ']', '[' . str_replace('"', '', $this->from) . ']', $sql);
        }

        return $sql;
    }

}
