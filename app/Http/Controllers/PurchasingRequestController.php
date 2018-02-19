<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzTableBuilder;
use App\PurchasingRequest;
use Illuminate\Http\Request;

class PurchasingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = PurchasingRequest::join('product_sub_categories','purchasing_requests.product_sub_category_id','=','product_sub_categories.id')
                                        ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
                                        ->join('companies','companies.id','=','purchasing_requests.company_id')
                                        ->join('addresses','addresses.company_id','=','companies.id')
                                        ->join('woredas','woredas.id','=','addresses.woreda_id')
                                        ->join('zones','woredas.zone_id','=','zones.id')
                                        ->join('regions','regions.id','=','zones.region_id')
                                        ->select(['product_sub_categories.name as subcategory',
                                            'product_categories.name as category',
                                            'purchasing_requests.product_name',
                                            'purchasing_requests.quantity',
                                            'purchasing_requests.created_at',
                                            'woredas.name as woreda',
                                            'zones.name as zone',
                                            'regions.name as region',
                                            'addresses.phone as phone',
                                            'companies.name as  company'
                                        ])->get();
        $inputs = [
            'headers' => [
                'FSC',
                'subcategory',
                'product name',
                'phone',
                'Address'
            ],
            'columns' => [
                'company',
                'subcategory',
                'product_name',
                'phone',
                'Address',
            ],
            'buttons' => [
                'edit'=> "cfc/inventory",
                'delete'=> "cfc/inventory"
            ]
        ];
        $title = "List of your inventories";
        $table = EzTableBuilder::getTable($inputs,$purchases);
        return view('EGAA.requests',compact(['purchases','table']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "send purchasing request to EGAA";
        return view('cfc.addPurchasingRequest',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PurchasingRequest::create([
            'company_id'=>auth()->user()->company_id,
            'product_sub_category_id'=>$request->subcategory,
            'product_name'=>$request->title,
            'quantity'=>$request->quantity
        ]);
        $message = "your purchasing request sent to EGAA successfully";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PurchasingRequest  $purchasingRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasingRequest $purchasingRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PurchasingRequest  $purchasingRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchasingRequest $purchasingRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PurchasingRequest  $purchasingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasingRequest $purchasingRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PurchasingRequest  $purchasingRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasingRequest $purchasingRequest)
    {
        //
    }
}
