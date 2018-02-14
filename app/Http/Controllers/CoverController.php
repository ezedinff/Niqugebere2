<?php

namespace App\Http\Controllers;

use App\Cover;
use App\EzBuilder\EzCardBuilder;
use App\EzBuilder\EzFormBuilder;
use Illuminate\Http\Request;

class CoverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Cover::where('company_id',auth()->user()->company_id)->get();
        if ($slide->count() > 0){
            $inputs = [
                'photo' => ['photo_path'],
                'labels'=> [''],
                'columns' => [''],
                'buttons' => [
                    'edit' => 'cfc/cover',
                    'delete' => 'cfc/cover',
                ]
            ];
            $title = "your company's cover picture";
            $card = EzCardBuilder::getCard($inputs,$slide);
            return view('cfc.supplies',compact(['card','title']));
        }else{
            $card = '<div class="col l4 m4 s12" >
                   <div class="card adder" style="height: 250px; background-color: #e3e3e3; text-align: center">
                        <div class="card-contnet" style="padding-top: 4.5em;">
                            <a href="'.url('cfc/cover/create').'" class="fa fa-plus flow-text" style="font-size: 5em; border-radius: 50%; border: 3px solid #505050; height: 100px; width: 100px;padding-top: 0.15em; color: #505050; text-decoration: none;"></a>
                        </div>
                   </div>
               </div>';
            $title = "you don't have cover picture yet. please add one.";
            return view('cfc.supplies',compact(['card','title']));
        }

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
                'type' => 'file',
            ],
        ];
        $action = "cfc/cover";
        $title = "add cover picture";
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
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $company_id = auth()->user()->company_id;
        Cover::create([
           'company_id'=>$company_id,
           'photo_path' => $uploadPath
        ]);
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully saved your cover picture";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function show(Cover $cover)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function edit(Cover $cover)
    {
        $inputs = [
            [
                'type' => 'file',
            ],
        ];
        $action = "cfc/cover/".$cover->id;
        $title = "update cover picture";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cover $cover)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $cover->photo_path = $uploadPath;
        $cover->save();
        $message = "you have successfully updated the cover picture";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cover  $cover
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cover $cover)
    {
        try {
            $cover->delete();
            $message = "you have successfully deleted the cover picture";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
