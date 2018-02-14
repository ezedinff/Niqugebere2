<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzCardBuilder;
use App\EzBuilder\EzFormBuilder;
use App\Logo;
use Illuminate\Http\Request;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $slide = Logo::where('company_id',auth()->user()->company_id)->get();
        if ($slide->count() > 0) {
            $inputs = [
                'photo' => ['photo_path'],
                'labels' => [''],
                'columns' => [''],
                'buttons' => [
                    'edit' => 'cfc/logo',
                    'delete' => 'cfc/logo',
                ]
            ];
            $title = "your company's logo";
            $card = EzCardBuilder::getCard($inputs, $slide);
            return view('cfc.supplies', compact(['card', 'title']));
        }else{
            $card = '<div class="col l4 m4 s12" >
                   <div class="card adder" style="height: 250px; background-color: #e3e3e3; text-align: center">
                        <div class="card-contnet" style="padding-top: 4.5em;">
                            <a href="'.url('cfc/logo/create').'" class="fa fa-plus flow-text" style="font-size: 5em; border-radius: 50%; border: 3px solid #505050; height: 100px; width: 100px;padding-top: 0.15em; color: #505050; text-decoration: none;"></a>
                        </div>
                   </div>
               </div>';
            $title = "you don't have logo yet. please add one.";
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
        $action = "cfc/logo";
        $title = "add your company's logo";
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
        Logo::create([
            'company_id'=>$company_id,
            'photo_path' => $uploadPath
        ]);
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully saved your logo";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function show(Logo $logo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function edit(Logo $logo)
    {
        $inputs = [
            [
                'type' => 'file',
            ],
        ];
        $action = "cfc/logo/".$logo->id;
        $title = "update your company's logo";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logo $logo)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $logo->photo_path = $uploadPath;
        $logo->save();
        $message = "you have successfully updated your logo";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Logo  $logo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logo $logo)
    {
        try {
            $logo->delete();
            $message = "you have successfully deleted your logo";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
