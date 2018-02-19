<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($title)
    {
        $services = Service::join('service_categories','service_categories.id','=','services.service_category_id')
            ->join('companies','companies.id','=','services.company_id')
            ->select(['services.title','services.description','services.id','services.created_at','companies.name as company'])
            ->orderBy('services.id','desc')
            ->where('service_categories.name',$title)->get();
        $ser = $services->first();
        return view('showService',compact(['services','title','ser']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "post your services";
        return view('cfc.addService', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Service::create([
           'company_id'=>auth()->user()->company_id,
           'service_category_id' => $request->category,
           'title' => $request->title,
           'description' => $request->text
        ]);
        $message = "you have successfully posted your service";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        $services = Service::join('service_categories','service_categories.id','=','services.service_category_id')
            ->join('companies','companies.id','=','services.company_id')
            ->select(['services.title','services.description','services.id','services.created_at','companies.name as company'])
            ->orderBy('services.id','desc')
            ->where('service_categories.id',$service->service_category_id)->get();
        $s = ServiceCategory::find($service->service_category_id);
        $title = $s->name;
        $ser = Service::join('companies','companies.id','=','services.company_id')
            ->select(['services.title','services.description','services.id','services.created_at','companies.name as company'])
                            ->where('services.id',$service->id)->get();
        return view('showService1',compact(['services','title','ser']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        //
    }
}
