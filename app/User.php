<?php

namespace App;

use App\Model\Permission;
use App\Model\PNK;
use App\Model\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role){

        if (is_string($role)) {
            return $this->role->get()->contains('slug', str_slug($role));
        }
        return false;
    }

    public function assign($role_name)
    {
        if (is_string($role_name)){
            $role = Role::where('slug', str_slug($role_name))->firstOrFail();
            return $this->role()->associate($role)->save();
        }
        return false;
    }

    public function assignUseModel(Role $role)
    {
        return $this->role()->associate($role);
    }

    public function setNullRole()
    {
        return $this->role()->dissociate()->save();
    }

    public function hasPermission($permission_name)
    {
        $role = $this->role;

        if ($role == null)
            return false;
        else return $role->hasPermission($permission_name);
    }

    public function hasPermissionUseModel(Permission $permission)
    {
        //return $this->role->
    }

    public function isFucker()
    {
        return is_null($this->role);
    }

    public function PNKs()
    {
        return $this->hasMany(PNK::class);
    }
}
