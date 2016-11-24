<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 11:09
 */

namespace App\Repository\Type;


use App\Model\Type;

class TypeEloquent implements TypeRepo
{
    private $type;

    public function __construct(Type $type)
    {
        $this->type = $type;
    }
    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->type->all($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        $t = $this->type->create($attributes);
        if (isset($attributes['type_id']))
        {
            $getArray = function ($item){
                return $item['id'];
            };
            $t->manufacturers()->attach(array_map($getArray, $attributes['type_id']));
        }
        return $t;
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        $type = Type::findOrFail($id);
        $type->update($attribute);
        return $type;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->type->destroy($id);
    }

    /**
     * @param $perpage
     * @param array $column
     * @return mixed
     */
    public function paginate($perpage, $column = ['*'])
    {
        return $this->type->paginate($perpage, $column);
    }

    public function get($id)
    {
        return $this->type->with(['manufacturers'])->findOrFail($id);
    }

}