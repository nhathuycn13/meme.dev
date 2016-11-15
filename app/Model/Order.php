<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['customer_id', 'order_type_id', 'shipping', 'description', 'payment_type_id', 'invoiced', 'user_id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(OrderType::class, 'order_type_id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id');
    }

    public function nextId($id)
    {
        return static::where('id', '>', $id)->first()->id;
    }
    public function previoustId($id)
    {
        return static::where('id', '<', $id)->first()->id;
    }
}
