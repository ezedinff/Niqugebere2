<?php

namespace App\Api\V1\Controllers;

use App\Woreda;
use App\WoredaTranslation;
use Dingo\Api\Http\Request;

class WoredaTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_woreda(Request $request)
    {
       $woredas= Woreda::all();

       return response()->json($woredas);

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
     * @param  \App\WoredaTranslation  $woredaTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(WoredaTranslation $woredaTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WoredaTranslation  $woredaTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(WoredaTranslation $woredaTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WoredaTranslation  $woredaTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WoredaTranslation $woredaTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WoredaTranslation  $woredaTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(WoredaTranslation $woredaTranslation)
    {
        //
    }
}
