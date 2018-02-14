<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\Path;
use App\Transportation;
use App\TransportationCategory;
use App\Vehicle;
use Illuminate\Http\Request;

class TransportationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportations = Transportation::join('transportation_categories','transportation_categories.id','=','transportations.transportation_category_id')
                                            ->join('paths','paths.id','=',"transportations.path_id")
                                            ->join('vehicles','vehicles.id','=','transportations.vehicle_id')
                                            ->where('transportations.company_id',auth()->user()->company_id)->get();
        return view('transporter.transportation',compact('transportations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create Transportation";
        return view('transporter.createTransportation',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //category,vehicle,path
        Transportation::create([
           'company_id'=> auth()->user()->company_id,
           'transportation_category_id'=> $request->category,
           'path_id'=>$request->path,
           'vehicle_id'=>$request->vehicle
        ]);
        $message = "you have successfully registered new transportation";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function show(Transportation $transportation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportation $transportation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportation $transportation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transportation  $transportation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transportation $transportation)
    {
        //
    }
}
