<?php

namespace App\Http\Controllers;

use App\Models\tasks_attachments;
use Illuminate\Http\Request;

class TasksAttachmentsController extends Controller
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
        
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',
    
            ], [
                'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',
            ]);
            
            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();
    
            $attachments =  new tasks_attachments();
            $attachments->file_name = $file_name;
            $attachments->refNum = $request->refNum;
            $attachments->id_task = $request->id_task;
            // $attachments->Created_by = Auth::user()->name;
            $attachments->save();
               
            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $request->id_task), $imageName);
            
            session()->flash('Add', 'تم اضافة المرفق بنجاح');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tasks_attachments  $tasks_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(tasks_attachments $tasks_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tasks_attachments  $tasks_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(tasks_attachments $tasks_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tasks_attachments  $tasks_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tasks_attachments $tasks_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tasks_attachments  $tasks_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(tasks_attachments $tasks_attachments)
    {
        //
    }
}