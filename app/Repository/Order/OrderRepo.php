<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 08/11/16
 * Time: 16:19
 */

namespace App\Repository\Order;


interface OrderRepo
{
    public function getAll($type = 0, $column = array('*'));
    public function create($attributes, $type = 2, $isOrder = false);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
    public function paginate($perpage = 15, $isOrder = false, $column = array('*'));

    public function sendMail($id, $type, $customer);
    public function printMe($id, $type = 0);
    public function setStatus($id, $status);
}