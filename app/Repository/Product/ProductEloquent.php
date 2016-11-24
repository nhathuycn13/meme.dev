<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 26/10/16
 * Time: 20:20
 */

namespace App\Repository\Product;


use App\Model\Product;

class ProductEloquent implements ProductRepo
{
    private $eloquent;

    public function __construct(Product $product)
    {
        $this->eloquent = $product;
    }

    /**
     * @param array $column
     * @return mixed
     */
    public function getAll($column = ['*'])
    {
        return $this->eloquent->with(['type', 'manufacturer'])->get($column);
    }

    public function paginate($perpage = 20, $column = ['*'])
    {
        return $this->eloquent->with(['type', 'manufacturer'])->paginate($perpage, $column);
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
        $e = Product::findOrFail($id);
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
        return $this->eloquent->with(['type', 'manufacturer'])->findOrFail($id);
    }

    public function search($keyword)
    {
        return $this->eloquent->search($keyword)->get();
    }

}