<?php

namespace App\Api\V1\Controllers;


use App\CarsType;

class CarsTypeController extends Controller
{
    //

    public function getCarTypes(){
        $carTypes=CarsType::where('name',"!=","")
                  ->select("id","name")->get();

        return response()->json($carTypes);
    }

}
