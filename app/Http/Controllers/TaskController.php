<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Equip;
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
use  App\Notifications\Reminder;
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
        $engineers = $engineers->unique('name');
        $areas =  Areas::all();
        $shifts = Shift::all();
        $tasks = Task::all();
        $stations = Stations::all();
        
        // $task_last_id = Task::latest()->first()->id;
        // $task_last_id++;
        return view('tasks.add_task', compact('engineers', 'areas', 'shifts', 'stations'));
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

        $validated = $request->validate([
            'ssname' => 'required|numeric',

        ],
        [
            'ssname.required' =>'يرجى اختيار اسم المحطة',
            'ssname.numeric'=>'يرجى اختيار المحطة من القائمة فقط'

        ]);
        $taskAlarmCount = Task::where('main_alarm',$request->main_alarm)
        ->where('station_id',$request->ssname)
        ->where("created_at",">", Carbon::now()->subMonths(6))
        ->count();
        Task::create([
            'refNum' => $request->refNum,
            'main_alarm' => $request->main_alarm,
            'station_id' => $request->ssname,
            'work_type' => $request->work_type,
            'Voltage_level' => $request->Voltage_Level,
            'make' => $request->make,
            'pm' => $request->pm,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_id' => $request->eng_name,
            'notes' => $request->notes,
            'status' => 'pending',
            'alarm_count'=>$taskAlarmCount,
            'user' => (Auth::user()->name),
        ]);

        $ssname = $request->ssname;
        $station_code=$request->station_code;
        $task_id = Task::latest()->first()->id;
        Tasks_details::create([
            'id_task' => $task_id,
            'refNum' => $request->refNum,
            'station_id' => $request->ssname,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_id' => $request->eng_name,
            'notes' => $request->notes,
            'status' => 'pending',
            'report_status'=>0,
            'user' => Auth::user()->name,
        ]);
        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
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
                ->notify(new AddTask($task_id, $data, $station_code));
        } else {
            //to send email with no attachment
            $engineer_email = $request->eng_name_email;
            Notification::route('mail', $engineer_email)
                ->notify(new AddTaskNoAttachment($task_id, $station_code));
        }
        //to check if the alarm is repeated in one station


      
   

   

        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();
    }

    public function storeWaitingToBeAssigned(Request $request){
        $validated = $request->validate([
            'ssname' => 'required|numeric',

        ],
        [
            'ssname.required' =>'يرجى اختيار اسم المحطة',
            'ssname.numeric'=>'يرجى اختيار المحطة من القائمة فقط'

        ]);

        Task::create([
            'refNum' => $request->refNum,
            'main_alarm' => $request->main_alarm,
            'station_id' => $request->ssname,
            'work_type' => $request->work_type,
            'Voltage_level' => $request->Voltage_Level,
            'make' => $request->make,
            'pm' => $request->pm,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'notes' => $request->notes,
            'status' => 'waiting',
            'user' => (Auth::user()->name),
        ]);
        $ssname = $request->ssname;
        $station_code=$request->station_code;
        $task_id = Task::latest()->first()->id;
        Tasks_details::create([
            'id_task' => $task_id,
            'refNum' => $request->refNum,
            'station_id' => $request->ssname,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => Auth::user()->name,
        ]);
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();
    }
   
    public function storeNightShift(Request $request){
        Task::create([
            'refNum' => $request->refNum,
            'main_alarm' => $request->main_alarm,
            'staion_id' => $request->ssname,
            'control' => $request->control_name,
            'full_name' => $request->staion_full_name,
            'work_type' => $request->work_type,
            'Voltage_level' => $request->Voltage_Level,
            'make' => $request->make,
            'pm' => $request->pm,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_name' => $request->eng_name,
            'eng_email' => $request->eng_name_email,
            'status' => 'completed',
            'user' => (Auth::user()->name),
            'color' => $request->color,
        ]);
        $ssname = $request->ssname;
        $task_id = Task::latest()->first()->id;
        Tasks_details::create([
            'id_task' => $task_id,
            'refNum' => $request->refNum,
            'ssname' => $request->ssname,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_name' => $request->eng_name,
            'report_date' => $request->task_Date,
            'status' => 'completed',
            'action_take'=>$request->action_take,
            'user' => Auth::user()->name,

        ]);

        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return back();
    }
    public function toBeAssigned(Request $request){
        $stations = Stations::all();
        return view('tasks.task_to_be_assigned', compact('stations'));
    }
    public function nightShift(){
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $areas =  Areas::all();
        $shifts = Shift::all();
        $tasks = Task::all();
        $stations = Stations::all();
        // $task_last_id = Task::latest()->first()->id;
        // $task_last_id++;
        return view('tasks.nightshift', compact('engineers', 'areas', 'shifts', 'stations'));
    }
    public function reminder($id, $eng_email, $ssname)
    {
        Notification::route('mail', $eng_email)
            ->notify(new Reminder($id, $ssname));
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
    public function update($id, Request $request)
    {
        $tasks = Task::findOrFail($id);
        $tasks_details = Tasks_details::where('id_task',$id);

        $tasks->update([
            'refNum' => $request->refNum,
            'main_alarm' => $request->main_alarm,
            'station_id' => $request->ssname,
            'work_type' => $request->work_type,
            'Voltage_level' => $request->Voltage_Level,
            'make' => $request->make,
            'pm' => $request->pm,
            'task_Date' => $request->task_Date,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_id' => $request->eng_name,
            'notes' => $request->notes,
            'status' => 'pending',
            'user' => (Auth::user()->name),
        ]);
        $tasks_details->update([
            'refNum' => $request->refNum,
            'station_id' => $request->ssname,
            'work_type' => $request->work_type,
            'equip' => $request->equip,
            'problem' => $request->problem,
            'eng_id' => $request->eng_name,
            'notes' => $request->notes,
            'user' => (Auth::user()->name),
        ]);

        $ssname = $request->ssname;
        $station_code=$request->station_code;
        $task_id =$id;
        if ($request->hasfile('pic')) {
            $task_id = Task::latest()->first()->id;
            foreach ($request->file('pic') as $file) {
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
                ->notify(new AddTask($task_id, $data, $station_code));
        } else {
            //to send email with no attachment
            $engineer_email = $request->eng_name_email;
            Notification::route('mail', $engineer_email)
                ->notify(new AddTaskNoAttachment($task_id, $station_code));
        }
        session()->flash('edit', 'تم   التعديل  بنجاح');

        return back();
    }
    public function selectEngineer($id){
        $stations = Stations::all();
        $tasks = Task::findOrFail($id);
        $tasks_details = Tasks_details::where('id_task',$id);

        return view('tasks.task_assignEngineer',compact('stations','tasks','tasks_details'));
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
    public function getEngineersArea($id, $shift_id)
    {
        // $engineers = DB::table("engineers")->where("area_id", $id)->pluck("email","name");
        return (string) Engineer::orderBy('name')
            ->where("area_id", $id)
            ->where("shift_id", $shift_id)->get();

        // return  json_encode($engineers);
    }
    public function getEquip($id){
        // $equipVoltageUnique = Equip::where('station_id',$id)->get();
        // $equipVoltageUnique = $equipVoltageUnique->unique('voltage_level');
        // return (string) $equipVoltageUnique;

        return (string)  Equip::where('station_id',$id)->orderBy('voltage_level')->get();
        
        // $equips = DB::table("equip")->where("station_id", $id)->pluck("voltage-level", "id");
        // return  json_encode($equips);

    }

    public function getEquipNumber($station_id,$voltage_level){
        return (string)  Equip::where('station_id',$station_id)
        ->where('voltage_level',$voltage_level)->get();

    }

    public function getEquipName($euipNumber){
        return (string)  Equip::where('eqiup_number',$euipNumber)->get();
    }

    public function getEngineersShift($area_id, $shift_id)
    {
        // $engineers = DB::table("engineers")->where("area_id", $area_id)->where("shift_id", $shift_id)->pluck("name", "id");
        // return  json_encode($engineers);
        return (string) Engineer::orderBy('name')
            ->where("area_id", $area_id)
            ->where("shift_id", $shift_id)->get();
    }
    public function getEngineersEmail($id)
    {
        return (string) Engineer::where("id", $id)->get();

        // $engineers = DB::table("engineers")
        // ->where("name", $id)
        // ->pluck("email","id");
        // return  json_encode($engineers);
    }
    public function task_uncompleted()
    {
        $tasks = Task::where('status', ('pending'))
            ->orderBy('id', 'desc')
            ->get();
        return view('tasks.task_uncompleted', compact('tasks'));
    }

    public function task_completed()
    {
        $tasks = Task::where('status', ('completed'))
            ->whereMonth('created_at', date('m'))
            ->orderBy('id', 'desc')
            ->get();
        return view('tasks.task_completed', compact('tasks'));
    }

    public function All_tasks()
    {
        $tasks = Task::whereMonth('created_at', date('m'))
            
            ->orderBy('id', 'desc')
            ->get();
   
        return view('tasks.showAllTasks', compact('tasks'));
    }

    public function archive()
    {
        $tasks = Task::where('status', ('completed'))
            ->orderBy('id', 'desc')
            ->get();
        return view('tasks.archive', compact('tasks'));
    }
    public function stationsByDates(Request $request)
    {
        $date1 = $request->task_Date;
        $date2 = $request->task_Date2;

        // $tasks = DB::table('tasks')
        //     ->whereBetween('task_Date', [$date1, $date2])
        //     ->where('status', ('completed'))
        //     ->get();

        $tasks = Task::whereBetween('task_Date', [$date1, $date2])
        ->where('status', ('completed'))
        ->get();
        return view('tasks.archive', compact('tasks'));
    }

    public function editTask($id)
    {
        $tasks = Task::findOrFail($id);
        $engineers = Task::findOrFail($id);
        $areas = Areas::all();
        $shifts = Shift::all();
        $stations = Stations::all();
        $task_attachments = tasks_attachments::all();
        return view('tasks.task_update', compact('tasks', 'engineers', 'areas', 'shifts', 'task_attachments', 'stations'));
    }

    public function getStationFullName($ssname)
    {
        return (string) Stations::where("SSNAME", $ssname)->first();
    }
}