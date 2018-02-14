<?php

namespace App\Api\V1\Controllers;

use App\Address;
use App\Company;
use App\Cover;
use App\Logo;
use App\Searchable;
use App\Slide;
use App\User;
use Dingo\Api\Auth\Auth;
use Dingo\Api\Http\Request;
use JWTAuth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getName(Request $request)
    {
        //
        $company=Company::where("id",$request->id)
            ->get();

        return response()->json($company);
    }

    public function aboutUs(Request $request){
        $about_us=Company::where('id',$request->id)
                  ->select("description")->get();
        return response()->json($about_us);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $currentuser= JWTAuth::parseToken()->authenticate();

        $profile=Company::where("id","=",$currentuser->company_id)
                 ->select("name","photo_path as logo","description")->get();
        return response()->json($profile);

    }

    public function uploadProfile(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $file_name = time().'.'.$request->photo->getClientOriginalExtension();
        $ocvers=new Cover();
        $ocvers->company_id=$currentuser->company_id;
        $ocvers->photo_path="uploads/".$file_name;
        if ($ocvers->save()){
            $request->photo->move(public_path('uploads'), $file_name);
            return response()->json([
                'status' =>'ok',
                'token' => "ok"
            ], 201);

        }
    }

    public function description(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();
        $company=Company::find($currentuser->company_id);
        $company->description=$request->description;
        if ($company->save()){
            return response()->json([
                'status' =>'ok',
                'token' => "ok"
            ], 201);
        }
    }

    public function show()
    {
        $companies= Company::join('covers','covers.company_id','=','companies.id')
                       ->where('companies.category_id','=','1')
                      ->select('companies.id','companies.name','covers.photo_path')->get();

        return response()->json($companies);

    }

    public function company_detail(Request $request){
        $company= Company::join('covers','covers.company_id','=','companies.id')
                 ->where('companies.id',$request->id)
                 ->select('companies.name','covers.photo_path as photo')->get();

        return response()->json($company);
    }

    public function approval(){

        $companies= Company::join('users','users.company_id','=','companies.id')
                   ->where('users.permission_id','0')
                   ->select("users.id","companies.name as company_name","users.first_name as owner_name","users.phone")->get();
        return response()->json($companies);
    }



}
