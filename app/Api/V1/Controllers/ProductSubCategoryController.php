<?php

namespace App\Api\V1\Controllers;

use App\ProductSubCategory;
use Dingo\Api\Http\Request;
use JWTAuth;
class ProductSubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request)
    {
        //
        $market_list=ProductSubCategory::where("product_category_id",$request->id)
                     ->select("id","name")->get();
        return response()->json($market_list);
    }

    public function getSubCategories(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();
        $product_sub_category=ProductSubCategory::where("product_category_id",$request->id)
            ->select("id","name")->get();
        return response()->json($product_sub_category);
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
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSubCategory $productSubCategory)
    {
        //
    }
}
