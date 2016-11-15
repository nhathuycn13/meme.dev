<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class QuoteAccept extends Model
{
    public $fillable = ['order_id', 'token'];
}
