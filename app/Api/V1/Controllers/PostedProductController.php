<?php

namespace App\Api\V1\Controllers;



use App\PostedProduct;
use Dingo\Api\Http\Request;

class PostedProductController extends Controller
{
    //

    public function getPostedProduct(Request $request){
        $posted_product=PostedProduct::join('product_sub_categories','product_sub_categories.id','=','posted_products.product_sub_category_id')
                       ->join("product_categories","product_categories.id","=","product_sub_categories.product_category_id")
                       ->where(['posted_products.company_id'=>$request->company_id,'posted_products.product_category_id'=>$request->product_category_id])
                       ->select("posted_products.id","posted_products.product_name","posted_products.unit","posted_products.unit_price","posted_products.quantity","posted_products.product_photo","product_sub_categories.name as sub_category_name")->get();

        return response()->json($posted_product);
    }


    public function getMarketPost(Request $request){
        $market_post=PostedProduct::where('product_sub_category_id','=',$request->id)
                    ->select("id","company_id","product_photo","product_name","unit_price")->get();
        return response()->json($market_post);
    }
}
