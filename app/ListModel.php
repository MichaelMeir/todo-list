<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListModel extends Model
{

	protected $table = 'lists';

    public function tasks() {
    	return $this->hasMany("App\TaskModel", "list_id");
    }

    public function lists() {
    	
    }
}
