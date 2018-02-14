<?php

namespace App\Api\V1\Controllers;

use App\ProductCategory;
use App\ProductCategoryTranslation;
use Illuminate\Http\Request;

class ProductCategoryTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProduct()
    {
       $products= ProductCategoryTranslation::where('name','<>','')->select('product_category_id as id','name')->get();

       return response()->json($products);
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
     * @param  \App\ProductCategoryTranslation  $productCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategoryTranslation $productCategoryTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategoryTranslation  $productCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategoryTranslation $productCategoryTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategoryTranslation  $productCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategoryTranslation $productCategoryTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategoryTranslation  $productCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategoryTranslation $productCategoryTranslation)
    {
        //
    }
}
