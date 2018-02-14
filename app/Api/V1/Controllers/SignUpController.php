<?php

namespace App\Api\V1\Controllers;

use App\Address;
use App\CarOwner;
use App\CategoryTranslation;
use App\Company;
use App\RegionTranslation;
use App\WoredaTranslation;
use App\ZoneTranslation;
use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use App\ProductCategoryTranslation;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $company=new Company;
        $company->name=$request->company_name;
        $company->tin=$request->tin_no;
        $company->category_id=$request->categor_id;
        $company->photo_path="";
        $company->description="";
        $company->save();
        if ($company->save()){
            $user = new User;
            $user->company_id=$company->id;
            $user->role_id='2';
            $user->permission_id='0';
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->tin=$request->tin_no;
            $user->phone=$request->phone_number;
            $user->password=bcrypt($request->password);
            $user->save();

            $address=new Address;
            $address->company_id=$company->id;
            $address->woreda_id=$request->woreda_id;
            $address->phone=$request->phone_number;
            $address->lon="";
            $address->lat="";
            $address->special_name=$request->special_name;
            $address->save();
            $token = $JWTAuth->fromUser($user);
            return response()->json([
                'status' => 'ok',
                'token' => $token
            ], 201);
        }


    }
}
