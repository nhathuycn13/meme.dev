<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Auth;
class PNK extends Model
{
    public $table = 'PNK';
    protected $fillable = ['status_id', 'user_id', 'tax', 'shipping', 'description'];

    public function CTPNKs()
    {
        return $this->hasMany(CTPNK::class, 'PNK_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'CTPNK', 'PNK_id');
    }
    
}
