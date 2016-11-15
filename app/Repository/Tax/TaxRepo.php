<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 08/11/16
 * Time: 15:14
 */

namespace App\Repository\Tax;


interface TaxRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
}