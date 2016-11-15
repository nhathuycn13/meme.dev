<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CTPNK extends Model
{
    public $table = 'CTPNK';
    public $fillable = ['PNK_id', 'product_id', 'qty', 'price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
