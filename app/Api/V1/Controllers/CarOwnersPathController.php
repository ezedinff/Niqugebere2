<?php

namespace App\Api\V1\Controllers;



use App\CarOwnersPath;
use Dingo\Api\Http\Request;

class CarOwnersPathController extends Controller
{
    //

    public function getNearByTransporter(Request $request){
        $nearby_transporter=CarOwnersPath::join('transportations','transportations.id','car_owners_paths.transportation_id')
                            ->join("transportation_paths",'transportation_paths.transportation_id','=','transportations.id')
                            ->join("car_owners","car_owners.id","car_owners_paths.car_owner_id")
                            ->where(['car_owners_paths.status'=>'1','transportation_paths.woreda_id'=>$request->woreda_id])
                            ->select("car_owners.id","car_owners.driver_name",'car_owners.type_of_car','car_owners.weight','car_owners.car_photo')->get();

        return response()->json($nearby_transporter);
    }
}
