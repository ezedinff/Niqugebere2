<?php

namespace App\Api\V1\Controllers;

use App\EzBuilder\EzTableBuilder;
use App\Language;
use App\Zone;
use App\ZoneTranslation;
use App\EzBuilder\EzFormBuilder;
use Dingo\Api\Http\Request;

class ZoneTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getZone(Request $request)
    {
        $zone_translation=Zone::join('zone_translations','zone_translations.zone_id','=','zones.id')
                          ->where('zones.region_id',$request->region)
                          ->select('zones.id','zone_translations.name')->get();

        return response()->json($zone_translation);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        $zones  = Zone::all();
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
                'options' => $zones
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => ''
            ]
        ];
        $action = "/admin/zones";
        $title = "Add zone's translation";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        return view('admin.formTemplate',compact(['form','title']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'language' => 'required',
           'zone'=> 'required',
           'name' => 'required'
        ]);
        ZoneTranslation::create([
            'zone_id' => $request->zone,
            'language_id' => $request->language,
            'name'=> $request->name
        ]);
        $message = "you have successfully saved the zone's translation";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ZoneTranslation  $zoneTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(ZoneTranslation $zoneTranslation)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ZoneTranslation  $zoneTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(ZoneTranslation $zoneTranslation)
    {
        $language = Language::find($zoneTranslation->language_id);
        $zone  = Zone::find($zoneTranslation->zone_id);
        $languages = Language::all();
        $zones = Zone::all();
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'language',
                'label' => 'language',
                'value' => $language,
                'options'=> $languages
            ],
            [
                'type' => 'select',
                'name'=> 'zone',
                'label' => 'zone',
                'value' => $zone,
                'options' => $zones
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'name',
                'value' => $zoneTranslation->name
            ]
        ];
        $action = "admin/zoneTranslation/" . $zoneTranslation->id;
        $title = "update zone's translation";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('admin.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ZoneTranslation  $zoneTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZoneTranslation $zoneTranslation)
    {
        $this->validate($request,[
            'language' => 'required',
            'zone'=> 'required',
            'name' => 'required'
        ]);
        $zoneTranslation->zone_id = $request->zone;
        $zoneTranslation->language_id = $request->language;
        $zoneTranslation->name = $request->name;
        $zoneTranslation->save();
        $message = "you have successfully updated the zone's translation";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ZoneTranslation  $zoneTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZoneTranslation $zoneTranslation)
    {
        try {
            $zoneTranslation->delete();
            $message = "you have successfully deleted the zone";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
