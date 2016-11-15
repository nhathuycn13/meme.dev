<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 29/10/16
 * Time: 09:56
 */

namespace App\Repository\PNK;


interface PNKrepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
    public function setStatus($idPNK, $status);
}