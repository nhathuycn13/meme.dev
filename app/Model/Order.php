<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = ['customer_id', 'order_status', 'description', 'tax', 'payment_type_id', 'invoice_id', 'user_id', 'isOrder'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type(){
        return $this->belongsTo(OrderStatus::class, 'order_status');
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
        $next = static::where('id', '>', $id)->first();
        return $next == null ? null : $next->id;
    }
    public function previoustId($id)
    {
        $next = static::where('id', '<', $id)->first();
        return $next == null ? null : $next->id;
    }
}
