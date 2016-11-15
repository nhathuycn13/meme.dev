<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public $table = 'status';
    protected $fillable = ['name'];
    public $timestamps = false;
}
