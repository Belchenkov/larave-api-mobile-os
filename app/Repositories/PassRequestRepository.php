<?php
/**
 * Created by black40x@yandex.ru
 * Date: 30/10/2019
 */

namespace App\Repositories;


use App\Models\Transit\DoSessionHeader;
use App\Structure\PassRequest\PassRequest;
use App\Structure\User\UserInterface;
use Illuminate\Database\Eloquent\Builder;

class PassRequestRepository
{

    public function getUserPassRequests(UserInterface $user) : Builder
    {
        return $user->passHeaders()->with('sprOffice', 'doSessionPass')->getQuery();
    }

    public function getUserPassRequest(UserInterface $user, $pass_id) : ?DoSessionHeader
    {
        return $user->passHeaders()->with([
            'doSessionPass',
            'sprOffice',
        ])->where('id', $pass_id)->first();
    }

    public function createPassRequest(UserInterface $user, PassRequest $structure) : ?DoSessionHeader
    {
        $header = DoSessionHeader::create([
            'Name_source' => 'mobapp',
            'Name_1C' => 'Заявка на пропуск',
            'descriptions' => 'Заявка на пропуск',
            'text_doc' => $structure->getTextDoc(),
            'employee' => $structure->getEmployee(),
            'employee_prepare' => $structure->getEmployee(),
            'status' => 0,
            'id_doc_source' => uniqid(),
            'offices_id' => $structure->getOfficeId()
        ]);

        $pass = $header->doSessionPass()->create([
            'Date_start' => $structure->getDate(),
            'Date_end' => $structure->getDate()->copy()->setHour(19),
            'visitor' => implode(', ', $structure->getVisitors()),
            'employee' => $structure->getEmployee(),
            'description' => $structure->getType(),
            'NumRow' => 1,
            'annotation' => $structure->getTextDoc()
        ]);

        return $header;
    }

}
