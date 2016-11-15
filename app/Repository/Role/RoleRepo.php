<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 23/10/16
 * Time: 18:28
 */

namespace App\Repository\Role;


interface RoleRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function paginate($perpage, $column = array('*'));
}