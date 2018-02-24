<?php

namespace App\Http\Controllers;

use App\DemandAggrement;
use App\TransportationBid;
use Illuminate\Http\Request;

class DemandAggrementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportations = DemandAggrement::join('companies','companies.id','=','demand_aggrements.company_id')
                                                ->join('addresses','demand_aggrements.company_id','=','addresses.company_id')
                                                ->join('woredas','woredas.id','addresses.woreda_id')
                                                ->select(['companies.name','woredas.name as woreda','addresses.phone','demand_aggrements.id'])
                                                ->where('demand_aggrements.win',1)->get();
        $to = DemandAggrement::join('demands','demands.id','=','demand_aggrements.demand_id')
            ->join('companies','companies.id','=','demands.company_id')
            ->join('addresses','companies.id','=','addresses.company_id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->select(['companies.name','woredas.name as woreda','addresses.phone','demands.total_quantity'])
            ->where('demand_aggrements.win',1)->get();
        return view('transporter.customers',compact(['transportations','to']));
    }
    public function showForDemandPoster(){
        $demandRequests = DemandAggrement::join('demands','demands.id','=','demand_aggrements.demand_id')
            ->join('companies','companies.id','=','demand_aggrements.company_id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['companies.name','woredas.name as woreda','zones.name as zone','regions.name as region','addresses.phone','demand_aggrements.id','demands.id as demand_id'])
            ->where(['demands.company_id' => auth()->user()->company_id, 'demand_aggrements.win' => 0])->get();
        return view('cfc.demandRequests',compact('demandRequests'));
    }
    public function demandAndSuppliesResponses(){
        $responseForDemands = DemandAggrement::join('demands','demands.id','=','demand_aggrements.demand_id')
            ->join('companies','companies.id','=','demands.company_id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['companies.name','woredas.name as woreda','zones.name as zone','regions.name as region','addresses.phone','demand_aggrements.id','demands.id as demand_id','demand_aggrements.win'])
            ->orderBy('demand_aggrements.created_at','desc')
            ->where('demand_aggrements.company_id',auth()->user()->company_id)->paginate(2);
        return view('cfc.myResponses',compact('responseForDemands'));
    }
    public function accept(DemandAggrement $agreement){
        $agreement->win = 1;
        $agreement->save();
        return redirect()->back();
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
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        DemandAggrement::create([
           'demand_id'=> $id,
           'company_id'=>auth()->user()->company_id
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DemandAggrement  $demandAggrement
     * @return \Illuminate\Http\Response
     */
    public function show(DemandAggrement $demandAggrement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DemandAggrement  $demandAggrement
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandAggrement $demandAggrement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DemandAggrement  $demandAggrement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DemandAggrement $demandAggrement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DemandAggrement  $demandAggrement
     * @return \Illuminate\Http\Response
     */
    public function destroy(DemandAggrement $demandAggrement)
    {
        //
    }
}
