<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Areas;
use App\Models\Shift;

use App\Models\completedTask;
use Illuminate\Http\Request;

class CompletedTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function fillTheTask($id){
        $tasks = Task::where('id', $id)->first();
        $areas = Areas::all();
        $shifts = Shift::all();
        return view('tasks.fill_task',compact('tasks','areas','shifts'));

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\completedTask  $completedTask
     * @return \Illuminate\Http\Response
     */
    public function show(completedTask $completedTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\completedTask  $completedTask
     * @return \Illuminate\Http\Response
     */
    public function edit(completedTask $completedTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\completedTask  $completedTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, completedTask $completedTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\completedTask  $completedTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(completedTask $completedTask)
    {
        //
    }
}