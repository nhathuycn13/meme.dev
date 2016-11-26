<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 07/11/16
 * Time: 11:14
 */

namespace App\Repository\Warehouse;


interface WarehouseRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
    public function paginate($perpage, $column = array('*'));
}