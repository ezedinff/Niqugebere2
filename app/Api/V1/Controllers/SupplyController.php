<?php

namespace App\Api\V1\Controllers;

use App\EzBuilder\EzCardBuilder;
use App\EzBuilder\EzFormBuilder;
use App\FcmClasses\FCMApi;
use App\FirebaseToken;
use App\ProductSubCategory;
use App\Supply;
use App\Woreda;
use Carbon\Carbon;
use Dingo\Api\Http\Request;
use JWTAuth;
class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function supplies()
    {
        $currentuser= JWTAuth::parseToken()->authenticate();
        $supply=Supply::join("companies",'companies.id','supplies.company_id')
                ->join('product_sub_categories','product_sub_categories.id','supplies.product_sub_category_id')
                ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
                ->where("supplies.company_id","!=",$currentuser->company_id)
                ->select("supplies.id","companies.name as company_name","companies.photo_path as company_photo","product_categories.name as category_name","product_sub_categories.name as sub_category_name","supplies.title","supplies.product_photo","supplies.price","supplies.total_quantity","supplies.availability","supplies.description")->get();

        return response()->json($supply);


    }

    public function mySupplyRequest(){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $my_request=Supply::join('supply_results',"supply_results.supplies_id","=","supplies.id")
            ->join("companies",'companies.id','supplies.company_id')
            ->join('product_sub_categories','product_sub_categories.id','supplies.product_sub_category_id')
            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
            ->where("supply_results.company_id",$currentuser->company_id)
            ->select("supplies.id","companies.name as company_name","companies.photo_path as company_photo","product_categories.name as category_name","product_sub_categories.name as sub_category_name","supplies.title","supplies.product_photo","supplies.price","supplies.total_quantity","supplies.availability","supplies.description")->get();
        return response()->json($my_request);
    }

    public function postSupply(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $file_name = time().'.'.$request->file->getClientOriginalExtension();
        $post_supply=new Supply();
       $post_supply->company_id=$currentuser->company_id;
       $post_supply->product_sub_category_id=$request->sub_category_id;
       $post_supply->title=$request->title;
       $post_supply->product_photo="uploads/".$file_name;
       $post_supply->price=$request->price;
       $post_supply->availability=$request->availability;
       $post_supply->description=$request->description;
       $post_supply->total_quantity='0';
       if ($post_supply->save()){
           $request->file->move(public_path('uploads'), $file_name);
           $fcm_api=new FCMApi();
           $tokens=FirebaseToken::all();
           foreach ($tokens as $t){
               $fcm_api->sendToken($t['token'],$request->title,$request->description);
           }
           return response()->json([
               'status' =>'ok',
               'token' => "ok"
           ], 201);
       }
    }

    public function showSupply(){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $show_supply=Supply::where("company_id",$currentuser->company_id)
                     ->join("product_sub_categories","product_sub_categories.id","=","supplies.product_sub_category_id")
                     ->join("product_categories","product_categories.id","=","product_sub_categories.product_category_id")
                     ->select("supplies.id","product_categories.name as category_name","product_sub_categories.name as sub_category_name","supplies.product_photo","supplies.price","supplies.title","supplies.availability")->get();

        return response()->json($show_supply);

    }

    public function supplyRequester(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $supply_request=Supply::join("supply_results","supply_results.supplies_id","=","supplies.id")
                     ->join("companies",'companies.id','supply_results.company_id')
                        ->join("product_sub_categories","product_sub_categories.id","=","supplies.product_sub_category_id")
                        ->join("product_categories","product_categories.id","=","product_sub_categories.product_category_id")
                        ->select("supplies.id","companies.photo_path as company_photo","companies.name as company_name","supply_results.quantity as total_quantity","supplies.product_photo","supplies.price","supplies.title","supplies.availability","product_categories.name as category_name","product_sub_categories.name as sub_category_name","supplies.product_photo")
                        ->where("supply_results.supplies_id",$request->id)->get();
        return response()->json($supply_request);
    }

    public function singleSupply(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $supply=Supply::where(['company_id'=>$currentuser->company_id,'id'=>$request->id])
                ->select('title',"product_photo")->get();

        return response()->json($supply);
    }

public function getPull(Request $request){


        $pull_data=Supply::join('companies','companies.id','=','supplies.company_id')
                   ->join('addresses','addresses.company_id','companies.id')
                   ->join('woredas','woredas.id','addresses.woreda_id')
                   ->where(['addresses.woreda_id'=>$request->woreda_id,'supplies.product_sub_category_id'=>$request->sub_id])
                   ->select("companies.name as company_name","supplies.title as product_name","supplies.total_quantity","woredas.name as woreda","addresses.special_name as special_name")->get();
        return response()->json($pull_data);



}
}
