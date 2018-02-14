<?php

namespace App\Api\V1\Controllers;


use App\Supply;
use App\SupplyResult;
use Dingo\Api\Http\Request;
use JWTAuth;
class SupplyResultController extends Controller
{
    //

    public function supplyRequest(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $supply_result=new SupplyResult();
        $supply_result->supplies_id=$request->id;
        $supply_result->company_id=$currentuser->company_id;
        $supply_result->quantity=$request->quantity;
        if ($supply_result->save()){
            return response()->json([
                'status' => 'ok',
                'token' => "ok"
            ], 201);
        }
    }
}
