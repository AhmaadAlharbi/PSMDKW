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
        if ($request->hasFile('pic')) {
            $task_id = Task::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $task_id), $imageName);
            $refNum = $request->refNum;
            $attachments = new tasks_attachments();
            $attachments->file_name = $file_name;
            $attachments->refNum = $refNum;
            $attachments->Created_by = Auth::user()->name;
            $attachments->id_task = $task_id;
            $attachments->save();
            //2nd pic
            if($request->hasFile('pic2')){
            $task_id = Task::latest()->first()->id;
            $image2 = $request->file('pic2');
            $file_name = $image2->getClientOriginalName();
            $attachments = new tasks_attachments();
            $attachments->file_name = $file_name;
            $attachments->refNum = $refNum;
            $attachments->Created_by = Auth::user()->name;
            $attachments->id_task = $task_id;
            $attachments->save();
            // move pic
            $imageName2 = $request->pic2->getClientOriginalName();
            $request->pic2->move(public_path('Attachments/' . $task_id), $imageName2);
            }else{
                $imageName2=null;
            }
            //3rd pic
            if($request->hasFile('pic3')){
                $task_id = Task::latest()->first()->id;
                $image3 = $request->file('pic3');
                $file_name = $image3->getClientOriginalName();
                $attachments = new tasks_attachments();
                $attachments->file_name = $file_name;
                $attachments->refNum = $refNum;
                $attachments->Created_by = Auth::user()->name;
                $attachments->id_task = $task_id;
                $attachments->save();
                // move pic
                $imageName3 = $request->pic3->getClientOriginalName();
                $request->pic3->move(public_path('Attachments/' . $task_id), $imageName3);
                }else{
                    $imageName3=null;
                }
                //4th file
                if($request->hasFile('pic4')){
                    $task_id = Task::latest()->first()->id;
                    $image4 = $request->file('pic4');
                    $file_name = $image4->getClientOriginalName();
                    $attachments = new tasks_attachments();
                    $attachments->file_name = $file_name;
                    $attachments->refNum = $refNum;
                    $attachments->Created_by = Auth::user()->name;
                    $attachments->id_task = $task_id;
                    $attachments->save();
                    // move pic
                    $imageName4 = $request->pic4->getClientOriginalName();
                    $request->pic4->move(public_path('Attachments/' . $task_id), $imageName4);
                    }else{
                        $imageName4=null;
                    }
                //5th file
                if($request->hasFile('pic5')){
                    $task_id = Task::latest()->first()->id;
                    $image5 = $request->file('pic5');
                    $file_name = $image5->getClientOriginalName();
                    $attachments = new tasks_attachments();
                    $attachments->file_name = $file_name;
                    $attachments->refNum = $refNum;
                    $attachments->Created_by = Auth::user()->name;
                    $attachments->id_task = $task_id;
                    $attachments->save();
                    // move pic
                    $imageName5 = $request->pic5->getClientOriginalName();
                    $request->pic5->move(public_path('Attachments/' . $task_id), $imageName5);
                    }else{
                        $imageName4=null;
                    }
            
          //to send email
          $engineer_email = $request->eng_name_email;
          Notification::route('mail', $engineer_email)
          ->notify(new AddTask($task_id,$imageName,$imageName2,$imageName3,$imageName4,$imageName5,$ssname));
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
          ->orderBy('id','desc')
                ->get();
        return view('tasks.task_uncompleted',compact('tasks'));
    }

    public function task_completed(){
        $tasks = Task::where('status',('completed'))
                ->orderBy('id','desc')
                ->get();
        return view('tasks.task_completed',compact('tasks'));
    }

    public function All_tasks(){
        $tasks = DB::table('tasks')
        ->orderBy('id','desc')
        ->get();
        return view('tasks.showAllTasks',compact('tasks'));

        
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