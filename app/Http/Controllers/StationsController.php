<?php

namespace App\Http\Controllers;
use App\Models\Stations;
use Illuminate\Http\Request;
class StationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Stations::orderBy('SSNAME')->get();
        return view('stations.stations_list',compact('stations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        Stations::create([
            'SSNAME'=>$request->ssname,
            'fullName'=>$request->fullName,
            'control'=>$request->control,
        ]);
        session()->flash('Add','تم اضافة المحطة بنجاح');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stations  $stations
     * @return \Illuminate\Http\Response
     */
    public function show(Stations $stations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stations  $stations
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $station = Stations::findOrFail($id);
        return view('stations.update_station',compact('station'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stations  $stations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $station = Stations::findOrFail($id);
        $station->update([
            'SSNAME'=>$request->ssname,
            'fullName'=>$request->fullName,
            'control'=>$request->control,
           
        ]);
        session()->flash('edit', 'تم   التعديل  بنجاح');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stations  $stations
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $station = Stations::findorFail($id);
        $station->delete();
        session()->flash('delete', 'تم  الحذف  بنجاح');
        return back();

    }
}