<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 14:13
 */

namespace App\Repository\Manufacturer;


use App\Model\Manufacturer;

class ManufacturerEloquent implements ManufacturerRepo
{
    private $manu;

    public function __construct(Manufacturer $manufacturer)
    {
        $this->manu = $manufacturer;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->manu->all($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        return $this->manu->create($attributes);
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        $m = Manufacturer::findOrFail($id);
        $m->update($attribute);
        return $m;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->manu->destroy($id);
    }

    /**
     * @param $perpage
     * @param array $column
     * @return mixed
     */
    public function paginate($perpage, $column = ['*'])
    {
        // TODO: Implement paginate() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return $this->manu->findOrFail($id);
    }

}