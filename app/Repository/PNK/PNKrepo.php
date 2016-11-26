<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 29/10/16
 * Time: 09:56
 */

namespace App\Repository\PNK;

use Illuminate\Http\Request;

interface PNKrepo
{
    public function getAll($column = array('*'));
    public function create(Request $attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
    public function setStatus($idPNK, $status);
    public function paginate($perpage, $column = array('*'));
}