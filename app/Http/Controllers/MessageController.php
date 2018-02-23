<?php

namespace App\Http\Controllers;

use App\Company;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::where('to_id',auth()->user()->company_id)->orderBy('created_at')->get();
        return view('cfc.messageEgaa',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "compose a message";
        $companies = Company::where('category_id',1)->get();
        return view('EGAA.message',compact(['title','companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data= array();
        $to = $request->to;
        for ($i = 0; $i < sizeof($to); $i++){
            $data[$i] = array('from_id' => auth()->user()->company_id,'to_id'=>$to[$i],'subject'=> $request->subject, 'message'=>$request->message,'created_at'=> Carbon::now(),'updated_at'=> Carbon::now());
        }
        Message::insert($data);
        $message = "the message sent successfully";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        return view('cfc.showMessageEgaa',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
