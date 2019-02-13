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

    	if(auth()->user()->id !== $task->list->user_id && auth()->user()->role->id !== 2) {
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

    	if(auth()->user()->id !== $task->list->user_id && auth()->user()->role->id !== 2) {
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

    	if(auth()->user()->id !== $list->user_id && auth()->user()->role()->id !== 2) {
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

    	if(auth()->user()->id !== $list->user_id && auth()->user()->role->id !== 2) {
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
    	$list = new ListModel;
    	$list->user_id = auth()->user()->id;
    	$list->name = "New List";
    	$list->save();
    	return $list;
    }

    public function deleteTask(Request $req, TaskModel $task) {
    	if(auth()->user()->id !== $task->list->user_id && auth()->user()->role->id !== 2) {
    		abort(404);
    	}
    	$task->forceDelete();
    	return response()->json([
    		'success' => true
    	]);
    }

    public function deleteList(Request $req, ListModel $list) {
    	if(auth()->user()->id !== $list->user_id && auth()->user()->role->id !== 2) {
    		abort(404);
    	}
    	$list->forceDelete();
    	return response()->json([
    		'success' => true
    	]);
    }
}
