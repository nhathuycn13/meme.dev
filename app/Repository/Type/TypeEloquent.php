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
        return $this->type->create($attributes);
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
        // TODO: Implement paginate() method.
    }

    public function get($id)
    {
        return $this->type->findOrFail($id);
    }

}