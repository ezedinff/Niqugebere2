<?php

namespace App\Api\V1\Controllers;

use App\Address;
use Dingo\Api\Http\Request;


class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companyAddress(Request $request)
    {
        $address=Address::join('woredas','woredas.id',"=",'addresses.woreda_id')
                 ->join("zones","zones.id","=","woredas.zone_id")
                 ->join("regions","regions.id","=","zones.region_id")
                 ->where("addresses.company_id",$request->company_id)
                 ->select('regions.name as region','zones.name as zone','woredas.name as woreda','addresses.special_name','addresses.phone','addresses.lon','addresses.lat')
                 ->get();

        return response()->json($address);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        //
    }
}
