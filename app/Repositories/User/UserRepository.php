<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25/09/2019
 */

namespace App\Repositories\User;


use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class UserRepository
{

    const DEPARTMENT_CACHE_TIME = 60 * 60 * 24;

    public static function getLatestSkudEvents($query)
    {
        $query->where(
            DB::raw("CAST(time as DATE)"),
            '>=',
            Carbon::now()->startOfDay()->format('Y-m-d')
        )->orderBy('time', 'ASC');
    }

    public function getDepartmentsChild($parent_id, $departments)
    {
        $items = collect();

        foreach ($departments as $department) {
            if ($department->id_1CParent == $parent_id) {
                $items->push($department);
                $items = $items->merge($this->getDepartmentsChild($department->id_1c, $departments));
            }
        }

        return $items;
    }

    public function getDepartmentsTree()
    {
        return Cache::remember('department.tree', self::DEPARTMENT_CACHE_TIME, function () {
            $departments = Transit1cDepartment::where('isdelete', 0)->where('base', 'DOC_FLOW')->get();

            foreach ($departments as $department) {
                if ($department->id_chief && !$department->id_1CParent) {
                    return $this->getDepartmentsChild($department->id_1c, $departments);
                }
            }

            return collect();
        });
    }

    public function getDepartmentsIds()
    {
        return Cache::remember('department.ids', self::DEPARTMENT_CACHE_TIME, function () {
            return $this->getDepartmentsTree()->map(function ($item) {
                return $item->id_1c;
            });
        });
    }

    public function getUserCatalog($search = null)
    {
        $catalog =
            Transit1cEmployee::with([
                'phPerson', 'departmentOrganisation', 'skudEvents' => function ($query) {
                    UserRepository::getLatestSkudEvents($query);
                }
            ])
                ->select(['transit_1c_employee.*', 'transit_1c_PhPerson.full_name'])
                ->leftJoin('transit_1c_PhPerson', function ($leftJoin) {
                    $leftJoin->on('transit_1c_employee.id_phperson', '=', 'transit_1c_PhPerson.id');
                })
                ->orderBy('transit_1c_PhPerson.full_name', 'ASC')
                ->whereNotNull('transit_1c_PhPerson.full_name')
                ->whereNotNull('transit_1c_employee.out_date')
                ->whereIn('transit_1c_employee.department_guid', $this->getDepartmentsIds()->toArray());

        if ($search) {
            $catalog->where('transit_1c_PhPerson.full_name', 'like', '%' . $search . '%');
        }

        return $catalog;
    }
}
