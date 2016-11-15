<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $fillable =['PNK_id', 'price', 'qty', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
