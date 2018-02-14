<?php

namespace App\Api\V1\Controllers;


use App\ServiceCategory;

class ServiceCategoryController extends Controller
{
    //

    public function getServices(){
        $services =ServiceCategory::where('name','!=','')
                   ->select('id','name','photo_path')->get();

        return response()->json($services);
    }
}
