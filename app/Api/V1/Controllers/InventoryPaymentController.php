<?php

namespace App\Api\V1\Controllers;


use App\InventoryPayment;
use Dingo\Api\Http\Request;
use JWTAuth;

class InventoryPaymentController extends Controller
{
    //

    public function myPayment(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $payment=InventoryPayment::join('companies',"companies.id",'=','inventory_payments.company_id')
                                   ->where("company_id",$currentuser->company_id)
                                   ->select("companies.name","companies.photo_path","inventory_payments.total_payment")
                                   ->get();

        return response()->json($payment);
    }
}
