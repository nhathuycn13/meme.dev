<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'detail', 'type_id', 'manufacturer_id', 'thumbnail'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
