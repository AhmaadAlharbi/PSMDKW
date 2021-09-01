<?php

namespace App\Http\Controllers;
use App\Models\Task;
use App\Models\Tasks_details;
use App\Models\tasks_attachments;
use Illuminate\Http\Request;
use App\Models\Engineer;
use App\Models\Shift;
use App\Models\Areas;
use App\Models\Stations;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use  App\Notifications\editTask;
use  App\Notifications\AddTask;
use  App\Notifications\editTaskNoAttachment;
use  App\Notifications\AddTaskNoAttachment;
use DB;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers ->unique('name');
        $areas =  Areas::all();
        $shifts = Shift::all();
        $tasks = Task::all();
        $stations = Stations::all();
        // $task_last_id = Task::latest()->first()->id;
        // $task_last_id++;
        return view('tasks.add_task',compact('engineers','areas','shifts','stations'));
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
        Task::create([
            'refNum' => $request->refNum,
            'main_alarm'=>$request->main_alarm,
            'ssname' =>$request->ssname,
            'control'=>$request->control_name,
            'full_name'=>$request->staion_full_name,
            'work_type'=>$request->work_type,
            'Voltage_level'=>$request->Voltage_Level,
            'task_Date' =>$request->task_Date,
            'equip'=>$request->equip,
            'problem'=>$request->problem,
            'eng_name'=>$request->eng_name,
            'notes'=>$request->notes,
            'status'=>'pending',
            'user' => (Auth::user()->name),
            'color'=>$request->color,

        ]);
        $ssname = $request->ssname;
        $task_id = Task::latest()->first()->id;
        Tasks_details::create([
            'id_task'=>$task_id,
            'refNum' => $request->refNum,
            'ssname' =>$request->ssname,
            'task_Date' =>$request->task_Date,
            'equip'=>$request->equip,
            'problem'=>$request->problem,
            'eng_name'=>$request->eng_name,
            'notes'=>$request->notes,
            'status'=>'pending',
            'user'=>Auth::user()->name,

        ]);
        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach($request->file('pic') as $file){
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/' . $task_id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new tasks_attachments();
                $attachments->file_name = $name;
                $attachments->refNum = $refNum;
                $attachments->Created_by = Auth::user()->name;
                $attachments->id_task = $task_id;
                $attachments->save();
            } 
          //to send email
          $engineer_email = $request->eng_name_email;
          Notification::route('mail', $engineer_email)
          ->notify(new AddTask($task_id, $data,$ssname));
        }else{
            //to send email with no attachment
        $engineer_email = $request->eng_name_email;
        Notification::route('mail', $engineer_email)
        ->notify(new AddTaskNoAttachment($task_id,$ssname));
        }
        
        session()->flash('Add','تم اضافةالمهمة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {       
        $tasks = Task::findOrFail($id);
        $tasks->update([
            'refNum' => $request->refNum,
            'main_alarm'=>$request->main_alarm,
            'ssname' =>$request->ssname,
            'full_name'=>$request->staion_full_name,
            'work_type'=>$request->work_type_text,
            'Voltage_level'=>$request->Voltage_Level,
            'task_Date' =>$request->task_Date,
            'equip'=>$request->equip,
            'problem'=>$request->problem,
            'eng_name'=>$request->eng_name,
            'notes'=>$request->notes,
            'status'=>'pending',
            'user' => (Auth::user()->name),
            'color'=>$request->color,
        ]);
        $ssname =$request->ssname;

        if ($request->hasFile('pic')) {
          
            $task_id = Task::findOrFail($id);
            $task_attachment = tasks_attachments::where('id_task',$id);
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $refNum = $request->refNum;
            $task_attachment->update([
                'file_name'=>$file_name,
                'refNum'=>$request->refNum,
                'id_task'=>$request->id
            ]);
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $id), $imageName,);
          //to send email
          $engineer_email = $request->eng_name_email;
          Notification::route('mail', $engineer_email)
          ->notify(new editTask($id,$imageName,$ssname));
        }else{
            //to send email with no attachment
        $engineer_email = $request->eng_name_email;
        Notification::route('mail', $engineer_email)
        ->notify(new editTaskNoAttachment($id,$ssname));
        }
        session()->flash('edit', 'تم   التعديل  بنجاح');

        return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $tasks = Task::where('id', $id)->first();
        $tasks->delete();
        return back();


    }
    public function getEngineersArea($id,$shift_id)
    { 
        // $engineers = DB::table("engineers")->where("area_id", $id)->pluck("email","name");
        return (string) Engineer::orderBy('name')
        ->where("area_id", $id) 
        ->where("shift_id", $shift_id)->get();

        // return  json_encode($engineers);
    }
    public function getEngineersShift($area_id ,$shift_id)
    { 
        // $engineers = DB::table("engineers")->where("area_id", $area_id)->where("shift_id", $shift_id)->pluck("name", "id");
        // return  json_encode($engineers);
        return (string) Engineer::orderBy('name')
        ->where("area_id", $area_id) 
        ->where("shift_id", $shift_id) ->get();

    }
    public function getEngineersEmail($id){
        return (string) Engineer::where("name", $id)->get();

        // $engineers = DB::table("engineers")
        // ->where("name", $id)
        // ->pluck("email","id");
        // return  json_encode($engineers);
    }
    public function task_uncompleted(){
        $tasks = Task::where('status',('pending'))
        ->whereMonth('created_at', date('m'))
        ->orderBy('id','desc')
         ->get();
        return view('tasks.task_uncompleted',compact('tasks'));
    }

    public function task_completed(){
        $tasks = Task::where('status',('completed'))
                 ->whereMonth('created_at', date('m'))
                 ->orderBy('id','desc')
                 ->get();
        return view('tasks.task_completed',compact('tasks'));
    }

    public function All_tasks(){
        $tasks = DB::table('tasks')
        ->whereMonth('created_at', date('m'))
        ->orderBy('id','desc')
        ->get();
        return view('tasks.showAllTasks',compact('tasks'));   
    }

    public function archive(){
        $tasks = Task::where('status',('completed'))
        ->orderBy('id','desc')
        ->get();
        return view ('tasks.archive',compact('tasks'));
    }
    public function stationsByDates(Request $request){
        $date1 = $request->task_Date;
        $date2= $request->task_Date2;

        $tasks = DB::table('tasks')
           ->whereBetween('task_Date', [$date1, $date2])
           ->where('status',('completed'))
           ->get();
        return view ('tasks.archive',compact('tasks'));

    }

    public function editTask($id){
        $tasks = Task::findOrFail($id);
        $engineers = Task::findOrFail($id);
        $areas = Areas::all();
        $shifts = Shift::all();
        $stations=Stations::all();
        $task_attachments = tasks_attachments::all();
        return view('tasks.task_update',compact('tasks','engineers','areas','shifts','task_attachments','stations'));

    }

   public function getStationFullName($ssname){
        return (string) Stations::where("SSNAME", $ssname)->first();
    }

}