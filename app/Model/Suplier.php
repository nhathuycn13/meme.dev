<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable = ['name', 'company_name', 'tax_id', 'bank_id', 'branch', 'phone', 'mobile', 'email', 'address', 'description'];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }
}
