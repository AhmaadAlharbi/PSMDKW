<?php

namespace App\Http\Controllers;

use App\Models\Engineer;
use App\Models\Areas;
use App\Models\Shift;

use Illuminate\Http\Request;

class EngineerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $area = Areas::all();
        $shift = Shift::all();
        $engineers = Engineer::all();
        return view('engineers.engineers_list',compact('area','shift','engineers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Engineer::create([
            'name'=>$request->eng_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'area_id'=>$request->area_id,
            'shift_id'=>$request->shift_id,

        ]);
        session()->flash('Add','تم الاضافة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function show(Engineer $engineer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $engineer = Engineer::findOrFail($id);
        return view('engineers.update_engineer',compact('engineer'));
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $engineer = Engineer::findOrFail($id);
        $engineer->update([
            'name'=>$request->eng_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'area_id'=>$request->area_id,
            'shift_id'=>$request->shift_id,
           
        ]);
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Engineer  $engineer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $engineer = Engineer::findorFail($id);
        $engineer->delete();
        session()->flash('delete', 'تم  الحذف  بنجاح');
        return back();
    }
}