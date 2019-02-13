<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{

	protected $table = 'roles';

    public function getRoledUsers(RoleModel $role) {
    	return $this->hasMany("App\User", "role_id")->where('name', $role->name);
    }

    public function users() {
    	return $this->hasMany('App\User');
    }
}
