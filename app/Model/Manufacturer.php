<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = ['name', 'code', 'description'];

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ($value);
        $this->attributes['slug'] = str_slug($value);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }
}
