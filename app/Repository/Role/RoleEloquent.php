<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 23/10/16
 * Time: 18:29
 */

namespace App\Repository\Role;


use App\Model\Role;

class RoleEloquent implements RoleRepo
{
    private $role;
    public function __construct(Role $role) {
        $this->role = $role;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->role->all($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        // TODO: Implement create() method.
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $perpage
     * @param array $column
     * @return mixed
     */
    public function paginate($perpage, $column = ['*'])
    {
        // TODO: Implement paginate() method.
    }

}