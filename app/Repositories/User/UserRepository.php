<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25/09/2019
 */

namespace App\Repositories\User;


use App\Models\Transit\_1C\Transit1cDepartment;
use App\Models\Transit\_1C\Transit1cEmployee;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class UserRepository
{

    public static function getLatestSkudEvents($query)
    {
        $query->where(
            DB::raw("CAST(time as DATE)"),
            '>=',
            Carbon::now()->startOfDay()->format('Y-m-d')
        )->orderBy('time', 'ASC');
    }

    public function getDepartmentsChild($parent_id, $departments, $asTree = false) : Collection
    {
        $items = collect();

        foreach ($departments as $department) {
            if ($department->id_1CParent == $parent_id) {
                if (!$asTree) {
                    $items->push($department);
                    $items = $items->merge($this->getDepartmentsChild($department->id_1c, $departments, $asTree));
                } else {
                    $department['items'] = $this->getDepartmentsChild($department->id_1c, $departments, $asTree);
                    $items->push($department);
                }
            }
        }

        return $items;
    }

    public function getDepartmentsTree($asTree = false)
    {
        $result = collect();
        $departments = Transit1cDepartment::select([
            'isdelete',
            'base',
            'id_chief',
            'name',
            'id_1c',
            'id_1CParent'
        ])
            ->where('isdelete', 0)
            ->where('active', 1)
            ->where('base', 'ЗУП Основа')
            ->with(['chief:id_phperson,id_1c,position,tab_no', 'chief.phPerson:id,full_name', 'realDepartment'])
            ->get();

        foreach ($departments as $department) {
            if (!$department->id_1CParent) {
                if ($asTree) {
                    $department['items'] = $this->getDepartmentsChild($department->id_1c, $departments, $asTree);
                    $result->push($department);
                } else {
                    $result->push($department);
                    $result = $result->merge($this->getDepartmentsChild($department->id_1c, $departments, $asTree));
                }
            }
        }

        return $result;
    }

    public function getDepartmentsIds()
    {
        return Cache::remember(
            'department.real.ids',
            config('cache.cache_time'),
            function() {
                return $this->getDepartmentsTree()->map(function ($item) {
                    if ($item->relationLoaded('realDepartment') && $item->realDepartment) {
                        return $item->realDepartment->Guid1cDepartmentOrganisation;
                    }
                    return $item->id_1c;
                });
            }
        );
    }

    public function getUserCatalog($search = null) : Builder
    {
        $catalog =
            Transit1cEmployee::with([
                'phPerson', 'departmentOrganisation', 'skudEvents' => function ($query) {
                    self::getLatestSkudEvents($query);
                }
            ])
                ->select(['transit_1c_employee.*', 'transit_1c_PhPerson.full_name', 'transit_spr_departmentorganisation.name'])
                ->leftJoin('transit_1c_PhPerson', function ($leftJoin) {
                    $leftJoin->on('transit_1c_employee.id_phperson', '=', 'transit_1c_PhPerson.id');
                })
                ->leftJoin('transit_spr_departmentorganisation', function ($leftJoin) {
                    $leftJoin->on('transit_spr_departmentorganisation.guid1c', '=', 'transit_1c_employee.department_guid');
                })
                ->orderBy('transit_1c_PhPerson.full_name', 'ASC');

        if ($search) {
            $catalog->where(function ($query) use ($search) {
                $query->where('transit_1c_PhPerson.full_name', 'like', '%' . $search . '%');
                $query->orWhere('transit_spr_departmentorganisation.name', 'like', '%' . $search . '%');
                $query->orWhere('transit_1c_employee.position', 'like', '%' . $search . '%');
            });
        }

        $catalog->where('transit_1c_employee.main_place', 1);
        $catalog->whereIn('transit_1c_employee.department_guid', $this->getDepartmentsIds()->toArray());
        $catalog->whereNotNull('transit_1c_PhPerson.full_name')
                ->whereNull('transit_1c_employee.out_date');

        return $catalog;
    }

    public function getUserProfileByTabNo(string $tab_no) : ?Transit1cEmployee
    {
        return Transit1cEmployee::with([
            'phPerson',
            'department',
            'coreUserData',
            'departmentOrganisation',
            'employeeStatus',
            'employeeChief',
            'skudEvents' => function ($query) {
                self::getLatestSkudEvents($query);
            }
        ])->where('tab_no', $tab_no)->first();
    }
}
