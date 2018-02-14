<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzCardBuilder;
use App\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::where('company_id',auth()->user()->company_id)->get();
        if ($slide->count() == 0){
            $card = '';
            $start = '<div class="col l4 m4 s12" >
                   <div class="card adder" style="height: 250px; background-color: #e3e3e3; text-align: center">
                        <div class="card-contnet" style="padding-top: 4.5em;">
                            <a href="'.url('cfc/slide/create').'" class="fa fa-plus flow-text" style="font-size: 5em; border-radius: 50%; border: 3px solid #505050; height: 100px; width: 100px;padding-top: 0.15em; color: #505050; text-decoration: none;"></a>
                        </div>
                   </div>
               </div>';
            for ($i=0; $i<3; $i++){
                $card .= $start;
            }
            $title = "you don't have any slide yet. please add one by clicking on plus button.";
            return view('cfc.supplies',compact(['card','title']));
        }elseif ($slide->count() == 1){
            $card = '';
            $start = '<div class="col l4 m4 s12" >
                   <div class="card adder" style="height: 250px; background-color: #e3e3e3; text-align: center">
                        <div class="card-contnet" style="padding-top: 4.5em;">
                            <a href="'.url('cfc/slide/create').'" class="fa fa-plus flow-text" style="font-size: 5em; border-radius: 50%; border: 3px solid #505050; height: 100px; width: 100px;padding-top: 0.15em; color: #505050; text-decoration: none;"></a>
                        </div>
                   </div>
               </div>';
            for ($i=0; $i<2; $i++){
                $card .= $start;
            }
            $inputs = [
                'photo' => ['photo_path'],
                'labels'=> ['first slogan','second slogan'],
                'columns' => ['caption1','caption2'],
                'buttons' => [
                    'edit' => 'cfc/slide',
                    'delete' => 'cfc/slide',
                ]
            ];
            $card .= EzCardBuilder::getCard($inputs,$slide);
            $title = "list of your slides please add one by clicking on plus button.";
            return view('cfc.supplies',compact(['card','title']));
        }elseif ($slide->count() == 2){
            $card = '';
            $start = '<div class="col l4 m4 s12" >
                   <div class="card adder" style="height: 250px; background-color: #e3e3e3; text-align: center">
                        <div class="card-contnet" style="padding-top: 4.5em;">
                            <a href="'.url('cfc/slide/create').'" class="fa fa-plus flow-text" style="font-size: 5em; border-radius: 50%; border: 3px solid #505050; height: 100px; width: 100px;padding-top: 0.15em; color: #505050; text-decoration: none;"></a>
                        </div>
                   </div>
               </div>';
            for ($i=0; $i<1; $i++){
                $card .= $start;
            }
            $inputs = [
                'photo' => ['photo_path'],
                'labels'=> ['first slogan','second slogan'],
                'columns' => ['caption1','caption2'],
                'buttons' => [
                    'edit' => 'cfc/slide',
                    'delete' => 'cfc/slide',
                ]
            ];
            $card .= EzCardBuilder::getCard($inputs,$slide);
            $title = "list of your slides please add one by clicking on plus button.";
            return view('cfc.supplies',compact(['card','title']));
        }
        $inputs = [
            'photo' => ['photo_path'],
            'labels'=> ['first slogan','second slogan'],
            'columns' => ['caption1','caption2'],
            'buttons' => [
                'edit' => 'cfc/slide',
                'delete' => 'cfc/slide',
            ]
        ];
        $title = "list of slides";
        $card = EzCardBuilder::getCard($inputs,$slide);
        return view('cfc.supplies',compact(['card','title']));
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
                'type' => 'text',
                'name'=> 'caption1',
                'label' => 'your first slogan',
                'value' => '',
                'options'=> ""
            ],
            [
                'type' => 'text',
                'name'=> 'caption2',
                'label' => 'your second slogan',
                'value' => '',
                'options' => ""
            ],
            [
                'type' => 'file',
            ]
        ];
        $action = "cfc/slide ";
        $title = "Add new slide";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pictures_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$pictures_name;
        $request->file->move(public_path('uploads'), $pictures_name);
        $company_id = auth()->user()->company_id;
        $s = Slide::create([
            'company_id' => $company_id,
            'caption1' => $request->caption1,
            'caption2' => $request->caption2,
            'photo_path' => $uploadPath
        ]);
        $message = "you have successfully saved the slide";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show(Slide $slide)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        $inputs = [
            [
                'type' => 'text',
                'name'=> 'caption1',
                'label' => 'your first slogan',
                'value' => $slide->caption1,
                'options'=> ""
            ],
            [
                'type' => 'text',
                'name'=> 'caption2',
                'label' => 'your second slogan',
                'value' => $slide->caption2,
                'options' => ""
            ],
            [
                'type' => 'file',
            ]
        ];
        $action = "cfc/slide/".$slide->id;
        $title = "update your slide";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $slide->caption1 = $request->caption1;
        $slide->caption2 = $request->caption2;
        $slide->photo_paht = $uploadPath;
        $slide->save();
        $message = "you have successfully updated the slide";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        try {
            $slide->delete();
            $message = "you have successfully deleted your slide";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
