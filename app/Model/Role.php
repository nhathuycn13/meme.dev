<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permission_name)
    {
        if (is_string($permission_name)){
            return $this->permissions->contains('slug', str_slug($permission_name));
        }
        return false;
    }

    public function assign($permission_name)
    {
        if (is_string($permission_name)){
            return $this->permissions()->save(Permission::where('slug', str_slug($permission_name))->firstOrFail());
        }
        return false;
    }

    public function setNullPermission()
    {
        return $this->permissions()->detach();
    }

    public function removePermission($permission_name)
    {
        if (is_string($permission_name)){
            $permission = Permission::where('slug', str_slug($permission_name))->firstOrFail();
            return $this->permissions()->detach($permission->id);
        }
//        if (is_array($permission_name)){
//            $permissions = Permission::where('slug', str_slug($permission_name))->get('id')->toArray();
//            return $this->permissions()->detach($permissions)->save();
//        }
        return false;
    }
}
