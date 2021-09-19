<?php

namespace App\Http\Controllers;

use App\Models\Tasks_details;
use App\Models\Engineer;
use App\Models\Stations;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\tasks_attachments;
use App\Models\Areas;
use App\Models\Shift;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use PDF;
use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

class TasksDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks_details  $tasks_details
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks_details $tasks_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks_details  $tasks_details
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks_details $tasks_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks_details  $tasks_details
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tasks = Tasks_details::where('id_task',$id);
        $tasks->update([
            'action_take' => $request->action_take,
   
        ]);
        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks_details  $tasks_details
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $invoices = tasks_attachments::findOrFail($request->id_file);
        $invoices->delete();
        Storage::disk('public_uploads')->delete($request->invoice_number . '/' . $request->file_name);
        session()->flash('delete', 'تم حذف المرفق بنجاح');
        return back();
    }

    public function fillTheTask($id)
    {
        $tasks = Task::where('id', $id)->first();
        $areas = Areas::all();
        $shifts = Shift::all();
        return view('tasks.fill_task', compact('tasks', 'areas', 'shifts'));
    }

    public function status_update($id)
    {
        $tasks = Task::findOrFail($id);
    }

    public function TaskCompleted(Request $request, $id)
    {
        $task_id = $id;
        Tasks_details::create([
            'id_task' => $task_id,
            'refNum' => $request->refNum,
            'station_id' => $request->ssname,
            'task_Date' =>Carbon::now(),
            'equip' => $request->equip,
            'problem' => $request->problem,
            'report_date' => $request->report_Date,
            'eng_id' => $request->eng_id,
            'notes' => $request->notes,
            'action_take' => $request->action_take,
            'status' => 'completed',
        ]);

        $tasks = Task::where('id', $task_id)->first();
        $tasks->update([
            'status' => 'completed',
        ]);

        if ($request->hasfile('pic')) {

            foreach ($request->file('pic') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('Attachments/' . $task_id), $name);
                $data[] = $name;
                $refNum = $request->refNum;
                $attachments = new tasks_attachments();
                $attachments->file_name = $name;
                $attachments->refNum = $refNum;
                $attachments->id_task = $task_id;
                $attachments->save();
            }
    
        } 
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');
        return view('tasks.completedMessage');
    }
    public function TaskPending(Request $request, $id)
    {
        $task_id = $id;
        $task = Task::findOrFail($task_id);

        if ($request->reason === 'مسؤولية جهة آخرى' || $request->reason === "تحت الكفالة") {

            $task->update([
                'status' => ('completed'),
            ]);

            Tasks_details::create([
                'id_task' => $task_id,
                'refNum' => $request->refNum,
                'station_id' => $request->ssname,
                'task_Date' => $request->task_Date,
                'equip' => $request->equip,
                'problem' => $request->problem,
                'report_date' => $request->report_Date,
                'eng_name' => $request->eng_name,
                'notes' => $request->notes,
                'action_take' => $request->action_take,
                'status' => 'completed',
                'reason' => $request->reason,
                'add_more' => $request->add_more,
            ]);
        } else {
            Tasks_details::create([
                'id_task' => $task_id,
                'refNum' => $request->refNum,
                'station_id' => $request->ssname,
                'task_Date' => $request->task_Date,
                'equip' => $request->equip,
                'problem' => $request->problem,
                'report_date' => $request->report_Date,
                'eng_name' => $request->eng_name,
                'notes' => $request->notes,
                'action_take' => $request->action_take,
                'status' => 'pending',
                'reason' => $request->reason,
                'add_more' => $request->add_more,
            ]);
        }
        session()->flash('Add', 'تم اضافةالمهمة بنجاح');

        return back();
    }

    public function showDetails($id)
    {
        $task = Task::where('id', $id)->first();
        $task_details = Tasks_details::where('id_task', $id)->get();
        $task_attachment = tasks_attachments::where('id_task', $id)->get();

        return view('tasks.task_details', compact('task', 'task_details', 'task_attachment'));
    }
    public function Print_task($id)
    {
        $task_details = Tasks_details::where('id_task', $id)->where('status', 'completed')->first();
        $task = Task::where('id', $id)->first();

        // $task =DB::table('tasks_details')
        //         ->where('id',$id)
        //         ->get();
        return view('tasks.Print_task', compact('task', 'task_details'));
    }



    public function addYourReport($id)
    {   $engineers = Engineer::all();
        $tasks = Task::where('id', $id)->first();
        return view('tasks.addYourReport', compact('tasks','engineers'));
    }

    public function open_file($id, $file_name)
    {
        $files = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($id . '/' . $file_name);
        return response()->file($files);
    }
    public function get_file($id, $file_name)
    {
        $contents = Storage::disk('public_uploads')->getDriver()->getAdapter()->applyPathPrefix($id . '/' . $file_name);
        return response()->download($contents);
    }


    //Blogs
    public function blogs()
    {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
        $tasks = Task::orderBy('id', 'desc')
            ->get()
            ->where('eng_id',Engineer::where('email',Auth::user()->email)->value('id'))
            ->where('status', 'pending');
        $task_details = Tasks_details::orderBy('id', 'desc')
            ->where('status', 'completed')
            ->paginate(6);
            $tasks_changed =Tasks_details::all(); 
        $date = Carbon::now();
        $monthName = $date->format('F');

        return view('blogs.index', compact('tasks', 'task_details', 'monthName','tasks_changed','engineers','stations'));
    }

    public function blogDetails($id)
    {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
        $blog_details = Tasks_details::where('id_task', $id)
            ->where('status', 'completed')
            ->first();
        $blog = Task::find($id);

        return view('blogs.report_details', compact('blog', 'blog_details', 'engineers', 'stations'));
    }
    public function blogByEngineer($id)
    {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
  
        $tasks = Task::orderBy('id', 'desc')
        ->get()
        ->where('eng_id',Engineer::where('email',Auth::user()->email)->value('id'))
        ->where('status', 'pending');
        $task_details = Tasks_details::orderBy('id', 'desc')
            ->where('eng_id',Engineer::where('name',$id)->value('id'))
            ->where('status', 'completed')
            ->paginate(6);    
            $date = Carbon::now();
            $monthName = $date->format('F');
        return view('blogs.searchByEngineer', compact('tasks', 'task_details','engineers','stations',));

    }
    public function blogByStation($id)
    {
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
        $tasks = Task::orderBy('id', 'desc')
        ->get()
        ->where('eng_id',Engineer::where('email',Auth::user()->email)->value('id'))
        ->where('status', 'pending');
        $task_details = Tasks_details::orderBy('id', 'desc')
        ->where('station_id',Stations::where('SSNAME',$id)->value('id'))
        ->where('status', 'completed')
        ->paginate(6);
            $date = Carbon::now();
            $monthName = $date->format('F');
        return view('blogs.searchByStation', compact('tasks', 'task_details','engineers','stations',));
    }
    public function userAll_tasks($eng_id){
        $engineer = Engineer::where('email',$eng_id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->orderBy('id', 'desc')
            ->get();
        return view('blogs.mytasks', compact('tasks'));
    }
    public function userUncompleted_tasks($eng_id){
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
        $engineer = Engineer::where('email',$eng_id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->where('status','pending')
            ->orderBy('id', 'desc')
            ->get();
        return view('blogs.tasks_uncompleted', compact('tasks','engineers','stations'));
    }
    public function usercompleted_tasks($eng_id){
        $engineers = Engineer::orderBy('name')->get();
        $engineers = $engineers->unique('name');
        $stations = Stations::orderBy('SSNAME')->get();
        $engineer = Engineer::where('email',$eng_id)->value('id');
        $tasks = Task::where('eng_id',$engineer)
            ->where('status','completed')
            ->orderBy('id', 'desc')
            ->get();
            $task_details = Tasks_details::where('eng_id',$engineer)
            ->where('status','completed')
            ->orderBy('id', 'desc')
            ->get();
        return view('blogs.task_completed', compact('tasks','task_details','engineers','stations'));
    }
    public function userEditReport($id){
        
        $tasks = Task::where('id',$id)->where('status','completed')->first();
         $tasks_details = Tasks_details::where('id_task',$id)->where('status','completed')->first();
         session()->flash('edit', 'تم  التعديل التقرير بنجاح');
         return view('blogs.editReport',compact('tasks','tasks_details'));
        }
    public function usershowDetails($id)
    {
        $task = Task::where('id', $id)->first();
        $task_details = Tasks_details::where('id_task', $id)->get();
        $task_attachment = tasks_attachments::where('id_task', $id)->get();

        return view('blogs.task_details', compact('task', 'task_details', 'task_attachment'));
    }
    public function userPrint_task($id)
    {
        $task_details = Tasks_details::where('id_task', $id)->where('status', 'completed')->first();
        $task = Task::where('id', $id)->first();

        // $task =DB::table('tasks_details')
        //         ->where('id',$id)
        //         ->get();
        return view('blogs.Print_task', compact('task', 'task_details'));
    }

    public function userArchive()
    {
        $tasks = Task::where('status', ('completed'))
            ->orderBy('id', 'desc')
            ->get();
        return view('blogs.archive', compact('tasks'));
    }
    public function userStationsByDates(Request $request)
    {
        $date1 = $request->task_Date;
        $date2 = $request->task_Date2;

        $tasks = DB::table('tasks')
            ->whereBetween('task_Date', [$date1, $date2])
            ->where('status', ('completed'))
            ->get();
        return view('blogs.archive', compact('tasks'));
    }
    public function error()
    {
        return view('404');
    }
}