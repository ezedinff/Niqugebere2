<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
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
        $inputs = [
            [
                'type' => 'number',
                'name'=> 'plate_no',
                'label' => 'plate number',
                'value' => '',
                'options'=> ""
            ],
            [
                'type' => 'number',
                'name'=> 'capacity',
                'label' => 'total capacity of the vehicle',
                'value' => '',
                'options' => ""
            ]
        ];
        $action = "transporter/vehicle";
        $title = "register new vehicle";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        return view('transporter.formTemplate',compact(['form','title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Vehicle::create([
           'company_id' => auth()->user()->company_id,
           'plate_no' => $request->plate_no,
           'capacity' => $request->capacity
        ]);
        $message = "you have successfully registered your vehicle.";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
