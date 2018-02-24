<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\Language;
use App\Region;
use App\Woreda;
use App\Zone;
use Illuminate\Http\Request;

class WoredaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Woreda::join('zones','zones.id','=','woredas.zone_id')
                        ->join('regions','regions.id','=','zones.region_id')
                        ->select(['zones.name as zone','regions.name as region', 'woredas.id','woredas.name as woreda'])->paginate(10);
        $languages = Language::all();
        $zone  = Zone::all();
        $regions = Region::all();
        $inputs = [ //woreda translations input
            [
                'type' => 'select',
                'name'=> 'language',
                'label' => 'language',
                'value' => '',
                'options'=> $languages
            ],
            [
                'type' => 'select',
                'name'=> 'region',
                'label' => 'regions',
                'value' => '',
                'options' => $regions
            ],
            [
                'type' => 'select',
                'name'=> 'zone',
                'label' => 'zones',
                'value' => '',
                'options' => ''
            ],
            [
                'type' => 'select',
                'name'=> 'woreda',
                'label' => 'woredas',
                'value' => '',
                'options' => ''
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => ''
            ]
        ];
        $action = "/admin/woredaTranslation";
        $title = "Add woreda's translation";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        $inputsZone = [
            [
                'type' => 'select',
                'name'=> 'region',
                'label' => 'region ',
                'value' => '',
                'options' => $regions
            ],
            [
                'type' => 'select',
                'name'=> 'zone',
                'label' => 'zone',
                'value' => '',
                'options' => ''
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => ''
            ]
        ];
        $titleZone = "Add a woreda";
        $actionZone = "/admin/zone";
        $formZone =  EzFormBuilder::getForm($inputsZone,$actionZone, "POST");

        return view('admin.woreda',compact(['form','title','zones','titleZone','formZone']));
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
     * @param  \App\Woreda  $woreda
     * @return \Illuminate\Http\Response
     */
    public function show(Woreda $woreda)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Woreda  $woreda
     * @return \Illuminate\Http\Response
     */
    public function edit(Woreda $woreda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Woreda  $woreda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Woreda $woreda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Woreda  $woreda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Woreda $woreda)
    {
        //
    }

    public function getWoreda(Request $request){
        $zones = Woreda::where('zone_id','=',$request->id)->get();
        return response()->json($zones);
    }
}
