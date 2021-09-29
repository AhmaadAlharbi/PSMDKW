<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Tasks_details;
use App\Models\User;
use App\Models\Engineer;
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
        $engineers = Engineer::all();
        $tasks = Task::orderBy('id', 'desc')
            ->where('status', 'pending')
            ->orWhere('status', 'waiting')
            ->get();

        $task_details = Tasks_details::orderBy('id', 'desc')
            ->whereMonth('created_at', date('m'))
            ->where('status', 'completed')
            ->paginate(4);
        $date = Carbon::now();
        $monthName = $date->format('F');

        return view('home', compact('engineers','tasks', 'task_details', 'monthName'));
    }
}