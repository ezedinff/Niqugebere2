<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function index()
    {
        $about = About::where('company_id',auth()->user()->company_id)->get();
        return view('cfc.about',compact('about'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        About::create([
        'company_id'=>auth()->user()->company_id,
        'description'=>$request->text
        ]);
        $message = "you have successfully set your about page";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }


    public function show(About $about)
    {
        //
    }


    public function edit(About $about)
    {
        //
    }


    public function update(Request $request, About $about)
    {
        //
    }


    public function destroy(About $about)
    {
        //
    }
}
