<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 18:18
 */

namespace App\Repository\Customer;


interface CustomerRepo
{
    public function getAll($column = array('*'));
    public function paginate($perpage, $column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
}