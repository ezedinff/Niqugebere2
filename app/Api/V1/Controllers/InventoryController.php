<?php

namespace App\Api\V1\Controllers;

use App\BitPolicy;
use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzTableBuilder;
use App\Inventory;
use App\InventoryPayment;
use App\ProductSubCategory;
use Dingo\Api\Http\Request;
use JWTAuth;
class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postInventory(Request $request)
    {
        $currentuser= JWTAuth::parseToken()->authenticate();
        $inventory=new Inventory();
        $inventory->company_id=$currentuser->company_id;
        $inventory->product_sub_category_id=$request->sub_category_id;
        $inventory->product_name=$request->product_name;
        $inventory->quantity=$request->quantity;
        if($inventory->save()){
            //bit calculation
            $bi_policy=BitPolicy::where('policy','!=',"")->get();
            $policy_no=$bi_policy[0]->policy;
            $policy_payment=$bi_policy[0]->payment;
            $total_payment=($request->quantity*$policy_payment)/$policy_no;
            //end of bit calculation

            //cfsc payment
            $payment_db=InventoryPayment::where("company_id",$currentuser->company_id)->get();
            if (count($payment_db)<=0){
                $payed=new InventoryPayment();
                $payed->company_id=$currentuser->company_id;
                $payed->total_payment=$total_payment;
                $payed->save();
                return response()->json([
                    'status' =>'ok',
                    'token' => $total_payment
                ], 201);
            }else{
                $save_payment=InventoryPayment::find($payment_db[0]->id);
                $total_save=$save_payment->total_payment;
                $total_save=$total_save+$total_payment;
                $save_payment->total_payment=$total_save;
                $save_payment->save();
                return response()->json([
                    'status' =>'ok',
                    'token' => $total_payment
                ], 201);
            }


        }
    }

}
