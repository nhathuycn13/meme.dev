<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 11:09
 */

namespace App\Repository\Type;


interface TypeRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function paginate($perpage, $column = array('*'));
    public function get($id);
}