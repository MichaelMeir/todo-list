<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function setRole(Request $req, RoleModel $role, User $user) {
    	if(auth()->user()->role->id === 2) {
    		$user->role_id = $role->id;
    		$user->save();
    		return response()->json([
    			'success' => 'true',
    			'role' => $role->name,
    			'user' => $user->name,
    			'user_id' => $user->id,
    		])
    	}else{
    		return response()->json([
    			'success' => 'false',
    			'role' => $user->role->name,
    			'user' => $user->name,
    			'user_id' => $user->id,
    		])
    	}
    }
}
