<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NK_Status extends Model
{
    public $table = 'NK_status';
    protected $fillable = ['name'];
    public $timestamps = false;
}
