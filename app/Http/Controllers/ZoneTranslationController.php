<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzTableBuilder;
use App\Language;
use App\Zone;
use App\ZoneTranslation;
use Illuminate\Http\Request;
use App\EzBuilder\EzFormBuilder;

class ZoneTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones  = ZoneTranslation::all();
        $inputs = [
          'headers' => [
            'name'
          ],
           'columns' => [
                'name'
            ],
            'buttons' => [
                'edit'=> "/admin/zoneTranslation",
                'delete'=> "/admin/zoneTranslation"
            ]
        ];
        $title = "List of zone translations";
        $table = EzTableBuilder::getTable($inputs,$zones);
        return view('admin.displayTemplate',compact(['table','title']));
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
