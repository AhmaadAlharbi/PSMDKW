<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tasks_details;
use App\Models\User;
use Carbon\Carbon;

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
         $tasks = Task::orderBy('id','desc')
         ->get()
         ->where('status','pending');
         $task_details = Tasks_details::orderBy('id','desc')
         ->whereMonth('created_at', date('m'))
         ->where('status','completed')
         ->get();
        $date = Carbon::now();
        $monthName = $date->format('F');

        return view('home',compact('tasks','task_details','monthName'));
    }

  
}