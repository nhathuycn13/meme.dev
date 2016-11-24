<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 18:16
 */

namespace App\Repository\Customer;


use App\Model\Customer;

class CustomerEloquent implements CustomerRepo
{
    private $eloquent;

    public function __construct(Customer $customer)
    {
        $this->eloquent = $customer;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->eloquent->all($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->eloquent->create($attributes);
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        $e = Customer::findOrFail($id);
        $e->update($attribute);
        return $e;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->eloquent->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->eloquent->findOrFail($id);
    }

    public function paginate($perpage, $column = ['*'])
    {
        return $this->eloquent->paginate($perpage, $column);
    }

}