<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskModel;
use App\ListModel;

class ListController extends Controller
{
    public function check(Request $req, TaskModel $task) {
    	if(!$req->ajax()) {
    		abort(404);
    	}

    	$req->validate([
    		'task' => 'required'
    	]);

    	$task->checked = !$task->checked;
    	$task->save();
    	return $task;
    }

    public function changeTask(Request $req, TaskModel $task) {
    	if(!$req->ajax()) {
    		abort(404);
    	}

    	$req->validate([
    		'body' => 'nullable'
    	]);

    	$task->body = $req->body;
    	$task->save();
    	return $task;
    } 

    public function changeList(Request $req, ListModel $list) {
    	if(!$req->ajax()) {
    		abort(404);
    	}

    	$req->validate([
    		'name' => 'nullable'
    	]);

    	$list->name = $req->name;
    	$list->save();
    	return $list;
    }

    public function newTask(Request $req, ListModel $list) {
    	if(!$req->ajax()) {
    		abort(404);
    	}

    	$req->validate([
    		'body' => 'required'
    	]);

    	$task = new TaskModel;
    	$task->list_id = $list->id;
    	$task->body = $req->body;
    	$task->user_id = 1;
    	$task->checked = false;
    	$task->save();
    	return $task;
    }

    public function newList(Request $req) {

    }

    public function deleteTask(Request $req, TaskModel $task) {

    }

    public function deleteList(Request $req, ListModel $list) {
    	
    }
}
