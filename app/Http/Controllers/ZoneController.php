<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\Language;
use App\Region;
use App\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::join('regions','regions.id','=','zones.region_id')
                        ->select(['zones.name as zone','regions.name as region', 'zones.id'])->paginate(10);
        $languages = Language::all();
        $zone  = Zone::all();
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'language',
                'label' => 'language',
                'value' => '',
                'options'=> $languages
            ],
            [
                'type' => 'select',
                'name'=> 'zone',
                'label' => 'zone',
                'value' => '',
                'options' => $zone
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => ''
            ]
        ];
        $action = "/admin/zoneTranslation";
        $title = "Add zone's translation";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        $regions = Region::all();
        $inputsZone = [
            [
                'type' => 'select',
                'name'=> 'zone',
                'label' => 'zone',
                'value' => '',
                'options' => $regions
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => ''
            ]
        ];
        $titleZone = "Add a zone";
        $actionZone = "/admin/zone";
        $formZone =  EzFormBuilder::getForm($inputsZone,$actionZone, "POST");

        return view('admin.zone',compact(['form','title','zones','titleZone','formZone']));
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
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit(Zone $zone)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Zone $zone)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy(Zone $zone)
    {
        //
    }

    public function getZone(Request $request){
        $zones = Zone::where('region_id','=',$request->id)->get();
        return response()->json($zones);
    }
}
