<?php
/**
 * Created by black40x@yandex.ru
 * Date: 25/09/2019
 */

namespace App\Repositories\User;

use App\Models\Transit\Portal\ForDepartment;
use App\Models\Transit\Portal\ForUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepository
 * @package App\Repositories\User
 * Пользователь системы
 */
class UserRepository
{

    /**
     * @param $query
     * Get Latest Records of Visit User
     */
    public static function getLatestSkudEvents($query)
    {
        $query->whereDate(
            'time',
            '>=',
            Carbon::now()->startOfDay()->format('Y-m-d')
        )->orderBy('time', 'ASC');
    }

    /**
     * @param $parent_id
     * @param $departments
     * @param bool $asTree
     * @return Collection
     * Get Departments Child
     */
    public function getDepartmentsChild($parent_id, $departments, $asTree = false) : Collection
    {
        $items = collect();

        foreach ($departments as $department) {
            if ($department->parent_external_id == $parent_id) {
                if (!$asTree) {
                    $items->push($department);
                    $items = $items->merge($this->getDepartmentsChild($department->external_id, $departments, $asTree));
                } else {
                    $department['items'] = $this->getDepartmentsChild($department->external_id, $departments, $asTree);
                    $items->push($department);
                }
            }
        }

        return $items;
    }

    /**
     * @param bool $asTree
     * @param null $parent
     * @return Collection
     * Get Departments in tree view
     */
    public function getDepartmentsTree($asTree = false, $parent = null)
    {
        $result = collect();
        $departments = ForDepartment::all();//get();

        foreach ($departments as $department) {
            if ($department->parent_external_id == $parent || $department->external_id == $parent) {
                if ($asTree) {
                    $department['items'] = $this->getDepartmentsChild($department->external_id, $departments, $asTree);
                    $result->push($department);
                } else {
                    $result->push($department);
                    $result = $result->merge($this->getDepartmentsChild($department->external_id, $departments, $asTree));
                }
            }
        }

        return $result;
    }

    /**
     * @param null $deprtment_id
     * @return mixed
     * Get Array of Departments Ids
     */
    public function getDepartmentsIds($deprtment_id = null)
    {
        return Cache::remember(
            'department.real.ids.'.$deprtment_id,
            config('cache.cache_time'),
            function() use ($deprtment_id) {
                return $this->getDepartmentsTree(false, $deprtment_id)->map(function ($item) {
                    return $item->external_id;
                });
            }
        );
    }

    /**
     * @param Collection $collection
     * @return Collection
     * Get Departments in collection view
     */
    public function getDepartmentsByCollection(Collection $collection)
    {
        $departments = collect();
        $departmentsAll = $this->getDepartmentsTree();

        foreach ($collection as $collect) {
            $departments->push($collect);
            $departments = $departments->merge($this->getDepartmentsChild($collect->external_id, $departmentsAll));
        }

        return $departments;
    }

    /**
     * @param Collection $collection
     * @return Collection
     * Get Departments Ids in collection view
     */
    public function getDepartmentsIdsByCollection(Collection $collection) {
        return $this->getDepartmentsByCollection($collection)->map(function ($item) {
            return $item->external_id;
        });
    }

    /**
     * @param null $search
     * @param Collection|null $department_ids
     * @return Builder
     * Get User Catalog
     */
    public function getUserCatalog($search = null, ?Collection $department_ids = null) : Builder
    {
        if (!$department_ids)
            $department_ids = $this->getDepartmentsIds();

        $department_ids = $department_ids->toArray();

        $catalog =
            ForUser::addSelect([
                    'for_users.*',
                    'for_department.name as department_name'
                ])
                ->with([
                    'department',
                    'skudEvents' => function ($query) {
                        self::getLatestSkudEvents($query);
                    }
                ])
                ->leftJoin('for_department', function ($leftJoin) {
                    $leftJoin->on('for_users.department_external_id', '=', 'for_department.external_id');
                })
                ->orderBy(DB::raw("(last_name + ' ' + first_name + ' ' + middle_name)"), 'ASC');

        if ($search) {
            $catalog->where(function ($query) use ($search) {
                $query->where(DB::raw("(for_users.last_name + ' ' + for_users.first_name + ' ' + for_users.middle_name)"), 'like', '%' . $search . '%');
                $query->orWhere('for_users.position_name', 'like', '%' . $search . '%');
                $query->orWhere('for_department.name', 'like', '%' . $search . '%');
                $query->orWhere('for_users.email', 'like', '%' . $search . '%');
                $query->orWhere('for_users.organisation_name', 'like', '%' . $search . '%');
            });
        }

        $catalog->where('for_users.enabled', 1);
        $catalog->whereIn('for_users.department_external_id', $department_ids);

        return $catalog;
    }

    /**
     * @param string $id_phperson
     * @return ForUser|null
     * Get User Profile Info by tab_no
     */
    public function getUserProfileByIdPerson(string $id_phperson) : ?ForUser
    {
        return ForUser::with([
            'department',
            'departmentChief',
            'employee',
            'employeeStatus',
            'manager',
            'managerSecond',
            'skudEvents' => function ($query) {
                self::getLatestSkudEvents($query);
            },
            'skudEvents.deviceRow'
        ])->where('id_phperson', $id_phperson)->first();
    }
}
