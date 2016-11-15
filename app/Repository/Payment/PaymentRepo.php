<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 08/11/16
 * Time: 14:55
 */

namespace App\Repository\Payment;


interface PaymentRepo
{
    public function getAll($column = array('*'));
    public function create($attributes);
    public function update($id, $attribute);
    public function delete($id);
    public function get($id);
}