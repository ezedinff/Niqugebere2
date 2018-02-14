<?php

namespace App\Api\V1\Controllers;

use App\ProductCategory;
use Dingo\Api\Http\Request;
use JWTAuth;


class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function markets()
    {
        //

        $markes=ProductCategory::where('name','!=',"")
               ->select("id","name")->get();
        return response()->json($markes);
    }

    public function productSelection(){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $products=ProductCategory::where('name','!=','')
                  ->select("id","name")->get();

        return response()->json($products);
    }

    public function getProductCateogry(){
        $currentuser= JWTAuth::parseToken()->authenticate();
        $products=ProductCategory::where('name','!=','')
            ->select("id","name")->get();

        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


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
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductCategory  $productCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
