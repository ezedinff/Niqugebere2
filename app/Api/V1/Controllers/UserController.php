<?php

namespace App\Api\V1\Controllers;

use App\Demand;
use App\Supply;
use App\User;
use Dingo\Api\Http\Request;
use JWTAuth;

class UserController extends Controller
{
    public function admin(){
        return view('admin.profile');
    }

    public function checkVerification()
    {
        $currentuser= JWTAuth::parseToken()->authenticate();

        $users_data=User::join('companies','users.company_id','=','companies.id')
            ->where('users.id',$currentuser->id)
            ->select('users.permission_id as status','companies.category_id as token')->get();
        return response()->json($users_data);

    }

    public function getCompany(){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $company=Company::where("id",$currentuser->company_id)
            ->select('name','photo_path')->get();

        return response()->json($company);
    }

    public function approveRequest(Request $request){
        $company_owner=User::find($request->id);
        $company_owner->permission_id="1";
        if ($company_owner->save()){
            return response()->json([
                'status' =>'ok',
                'token' => "ok"
            ], 201);
        }

    }

}