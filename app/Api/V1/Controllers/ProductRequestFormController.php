<?php

namespace App\Api\V1\Controllers;


use App\ProductRequestForm;
use Dingo\Api\Http\Request;

class ProductRequestFormController extends Controller
{
    //

    public function orders(Request $request){
        $product_request=new ProductRequestForm();
        $product_request->woreda_id=$request->woreda_id;
        $product_request->full_name=$request->full_name;
        $product_request->phone_number=$request->phone_no;
        $product_request->request_type="1";
        $product_request->posted_product_id=$request->post_product_id;
        $product_request->product_sub_category_id='0';
        $product_request->quantity=$request->total_quantity;
        $product_request->delivery_time="";
        $product_request->description="";

        $request=$product_request->save();
        return response()
            ->json([
                'status' => $request,
                'token' => "0",
            ],201);
    }
}
