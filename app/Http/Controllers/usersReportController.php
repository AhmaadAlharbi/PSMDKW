<?php

namespace App\Http\Controllers;
use App\Models\Task;

use Illuminate\Http\Request;

class usersReportController extends Controller
{
    public function task_completed(){
        $tasks = Task::where('status',('completed'))
                ->orderBy('id','desc')
                ->get();
        return view('blogs.task_completed',compact('tasks'));
    }
}