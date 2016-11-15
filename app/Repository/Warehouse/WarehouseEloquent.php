<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 07/11/16
 * Time: 11:15
 */

namespace App\Repository\Warehouse;


use App\Model\PNK;
use App\Model\Product;
use App\Model\Warehouse;

class WarehouseEloquent implements WarehouseRepo
{
    private $warehouse;
    /**
     * WarehouseEloquent constructor.
     */
    public function __construct(Warehouse $warehouse) {
        $this->warehouse = $warehouse;
    }
    /**
     * @param array $column
     * @return mixed
     */

    public function getAll($column = ['*'])
    {
        return $this->warehouse->with('product')->get($column);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    public function create($attributes)
    {
        if (is_array($attributes)){
            return $this->warehouse->create($attributes);
        }else{
            $products = PNK::findOrFail($attributes)->CTPNKs;
            foreach ($products as $product){
                $temp = $this->warehouse->where('product_id', $product->product_id)->where('price', $product->price)->first();
                if (isset($temp)){
                    $temp->qty += $product->qty;
                    $temp->save();
                    return 'meme';
                }
                $this->warehouse->create($product->toArray());
            }
        }
    }

    /**
     * @param $id
     * @param $attribute
     * @return mixed
     */
    public function update($id, $attribute)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
    }



}