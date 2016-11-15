<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'mobile', 'fax', 'address', 'company_name', 'email', 'tax_id', 'note'];
}
