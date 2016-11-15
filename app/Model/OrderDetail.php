<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $fillable = ['order_id', 'product_id', 'qty', 'price', 'discount', 'tax', 'description'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
