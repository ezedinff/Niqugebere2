<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    public function goToMarket($title){
        $product_category = ProductCategory::where('name',$title)->get();
        $color = self::getColor($title);
        $id = $product_category[0]->id;
        return view('market',compact(['title','id','color']));
    }
    public function getColor($type){
        $color = "";
        if ($type == "Seeds"){
            $color = "blue";
        }
        elseif ($type == "Fertilizers"){
            $color = "orange";
        }
        elseif ($type == "Feeds"){
            $color = "green";
        }
        elseif ($type == "Agro-chemical"){
            $color = "red";
        }
        elseif ($type == "Agricultural Equipments"){
            $color = "purple";
        }
        elseif ($type == "Veterinary Drugs"){
            $color = "brown";
        }
        return $color;
    }
}
