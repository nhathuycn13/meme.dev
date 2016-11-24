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
//        return $attributes;
        $m = $this->manu->create($attributes);
        if (isset($attributes['type_id']))
        {
            $getArray = function ($item){
                return $item['id'];
            };
            $m->types()->attach(array_map($getArray, $attributes['type_id']));
        }
        return $m;
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
        return $this->manu->paginate($perpage, $column);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {

        return $this->manu->with(['types'])->findOrFail($id);
    }

}