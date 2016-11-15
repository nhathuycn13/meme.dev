<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 14:40
 */

namespace App\Repository\Supplier;


interface SupplierRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
}