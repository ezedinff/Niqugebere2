<?php

namespace App\Api\V1\Controllers;

use App\ProductSubCategory;
use App\ProductSubCategoryTranslation;
use Dingo\Api\Http\Request;

class ProductSubCategoryTranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCategory(Request $request)
    {

        $product=ProductSubCategory::join('product_sub_category_translations','product_sub_category_translations.product_sub_category_id','=','product_sub_categories.id')
                 ->where('product_sub_categories.product_category_id',$request->pr_id)
                 ->select('product_sub_category_translations.id','product_sub_category_translations.name')->get();

        return response()->json($product);

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
     * @param  \App\ProductSubCategoryTranslation  $productSubCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubCategoryTranslation $productSubCategoryTranslation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSubCategoryTranslation  $productSubCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSubCategoryTranslation $productSubCategoryTranslation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSubCategoryTranslation  $productSubCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSubCategoryTranslation $productSubCategoryTranslation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSubCategoryTranslation  $productSubCategoryTranslation
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSubCategoryTranslation $productSubCategoryTranslation)
    {
        //
    }
}
