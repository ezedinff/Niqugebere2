<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        return view('cfc.news');
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        News::create([
            'company_id'=>auth()->user()->company_id,
            'title'=>$request->title,
            'description'=>$request->text
        ]);
        $message = "you have successfully posted a news";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    public function show(News $news)
    {
        //
    }

    public function edit(News $news)
    {
        //
    }

    public function update(Request $request, News $news)
    {
        //
    }


    public function destroy(News $news)
    {
        //
    }
}
