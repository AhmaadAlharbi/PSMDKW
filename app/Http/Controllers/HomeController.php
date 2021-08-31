<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tasks_details;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         $tasks = Task::orderBy('id','desc')->get()
         ->take(5);
         $task_details = Tasks_details::orderBy('id','desc')
         ->where('status','completed')
         ->get()
         ->take(5);

        return view('home',compact('tasks','task_details'));
    }

  
}