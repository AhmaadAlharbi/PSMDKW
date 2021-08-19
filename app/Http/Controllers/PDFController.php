<?php
  
namespace App\Http\Controllers;
use App\Models\Tasks_details;
use App\Models\Task;

use Illuminate\Http\Request;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {

        // $stations = Stations::findOrFail($id);
        $task_details = Tasks_details::where('id_task', $id)
        ->where('status','completed')
        ->firstOrFail();

        $task = Task::where('id', $id)
        ->where('status','completed')
        ->firstOrFail();

          $data = [
            'task_details' =>$task_details,
            'task'=>$task,
        ];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('Report '.$task->id.'.pdf');

    }
}