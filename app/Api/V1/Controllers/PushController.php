<?php

namespace App\Api\V1\Controllers;


use App\Company;
use App\Languages;
use App\Push;
use Dingo\Api\Http\Request;
use JWTAuth;

class PushController extends Controller
{
    //

    public function push(Request $request){
        $push =new Push;
        $push->woreda_id=$request->woreda_id;
        $push->product_category_id=$request->product_category_id;
        $push->quantity=$request->quantity;
        $push->delivery_time=$request->delivery_time;
        $push->phone_number=$request->phone_number;
        $push->description=$request->description;
        if ($push->save()){
            return response()->json(['status'=>'ok','token'=>'0'],201);
        }else{
            return response()->json(['status'=>'fail','token'=>'0'],201);

        }
    }

    public function getPush(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $language=Languages::where('name',$request->lan)->get();
        $language_id=$language[0]['id'];

        $push_data=Company::join('addresses','companies.id','=','addresses.company_id')
                  ->join("pushes",'pushes.woreda_id','addresses.woreda_id')
                  ->join('product_sub_category_translations','product_sub_category_translations.product_sub_category_id','pushes.product_category_id')
                  ->where('product_sub_category_translations.language_id',$language_id)
                  ->select('pushes.delivery_time','pushes.quantity','pushes.description','pushes.phone_number','product_sub_category_translations.name as product_name')
                  ->get();

        return response()->json($push_data);
    }
}
