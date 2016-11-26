<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 08/11/16
 * Time: 14:55
 */

namespace App\Repository\Payment;


use App\Model\PaymentType;
use App\Repository\ParentRepo;

class PaymentEloquent implements PaymentRepo
{
    /**
     * @var PaymentType
     */
    private $payment;

    /**
     * @inheritDoc
     */
    public function __construct(PaymentType $paymentType) { $this->payment = $paymentType; }

    public function getAll($column = ['*'])
    {
        return $this->payment->get($column);
    }

    public function create($attributes)
    {

    }

    public function update($id, $attribute)
    {
        // TODO: Implement update() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function get($id)
    {
        // TODO: Implement get() method.
    }


}