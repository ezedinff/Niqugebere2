<?php

namespace App\Api\V1\Controllers;


use App\company_delivering_product;
use Dingo\Api\Http\Request;
use JWTAuth;
class CompanyDeliveringProductController extends Controller
{
    //

    public function getCompanyProducts(Request $request){

        $products=company_delivering_product::join('product_categories','company_delivering_products.product_category_id','=','product_categories.id')
                 ->where("company_delivering_products.company_id",$request->id)
                 ->select("company_delivering_products.company_id as id","product_categories.id as product_id","product_categories.name","product_categories.product_photo as photo")
                 ->get();

        return response()->json($products);
    }

    public function companyProvidingProducts(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $company_delivering=new Company_delivering_product();
        $company_delivering->company_id=$currentuser->company_id;
        $company_delivering->product_category_id=$request->id;
        $company_delivering->product_sub_category_id='0';
        if ($company_delivering->save()){
            return response()->json([
                'status' =>'ok',
                'token' => "ok"
            ], 201);
        }
    }
}
