<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
    	return view('login');
    }

    public function login(Request $req) {
    	$req->validate([
    		'name' => 'required',
    		'password' => 'required'
    	]);

    	if($req->ajax() && Auth::attempt($req->only('name', 'password'))) {
    		return redirect('/');
    	}
    	return redirect('/login');
    }

    public function logout() {
    	if (auth()->user()) {
            Auth::logout();
            return redirect()->route('login');
        } else {
            abort(404);
        }
    }
}
