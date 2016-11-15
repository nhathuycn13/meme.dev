<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 14:41
 */

namespace App\Repository\Supplier;


use App\Model\Suplier;

class SupplierEloquent implements SupplierRepo
{
    private $supplier;

    public function __construct(Suplier $suplier)
    {
        $this->supplier = $suplier;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->supplier->all();
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->supplier->create($attributes);
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        $s = Suplier::findOrFail($id);
        $s->update($attribute);
        return $s;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->supplier->destroy($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->supplier->findOrFail($id);
    }

}