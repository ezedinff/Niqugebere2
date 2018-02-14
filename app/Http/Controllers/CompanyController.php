<?php

namespace App\Http\Controllers;

use App\Address;
use App\Company;
use App\Logo;
use App\Searchable;
use App\Slide;
use App\User;
use Dingo\Api\Auth\Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getFSC(){
        $tobeVerfied = Company::join('users','users.company_id','=','companies.id')
                        ->join('addresses','addresses.company_id','=','companies.id')
                        ->join('woredas','woredas.id','=','addresses.woreda_id')
                        ->join('zones','woredas.zone_id','=','zones.id')
                        ->join('regions','regions.id','=','zones.region_id')
                        ->select(['companies.id','companies.name','companies.tin','addresses.phone','regions.name as region','zones.name as zone','woredas.name as woreda'])
                        ->where('companies.category_id',1)
                        ->where('users.permission_id','=',2)->get();
        $verfied =  Company::join('users','users.company_id','=','companies.id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['companies.id','companies.name','companies.tin','addresses.phone','regions.name as region','zones.name as zone','woredas.name as woreda'])
            ->where('companies.category_id',1)
            ->get();
        $company = "commercial farm centers";
        return view('admin.company', compact(['tobeVerfied','verfied','company']));
    }
    public function getSuppliers(){
        $tobeVerfied = Company::join('users','users.company_id','=','companies.id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['companies.id','companies.name','companies.tin','addresses.phone','regions.name as region','zones.name as zone','woredas.name as woreda'])
            ->where('companies.category_id',2)
            ->where('users.permission_id','=',2)->get();
        $verfied =  Company::join('users','users.company_id','=','companies.id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['companies.id','companies.name','companies.tin','addresses.phone','regions.name as region','zones.name as zone','woredas.name as woreda'])
            ->where('companies.category_id',2)
            ->get();
        $company = "suppliers";
        return view('admin.company', compact(['tobeVerfied','verfied','company']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $company = Company::create([
            'name'=>$request->name,
            'tin'=>$request->tin,
            'category_id'=>$request->category,
            'product_category_id'=>$request->product
        ]);
        if ($company){
            Address::create([
                'company_id'=>$company->id,
                'woreda_id'=>$request->woreda,
                'phone'=>$request->phone,
                'special_name'=>$request->special
            ]);
            User::create([
                'company_id'=>$company->id,
                'role_id' => 2,
                'permission_id' =>1,
                'first_name' => ucfirst($request->first_name),
                'last_name' => ucfirst($request->last_name),
                'tin'=>$request->tin,
                'phone'=>$request->phoneu,
                'password'=>bcrypt($request->password)
            ]);
            Searchable::create([
                'name' => $request->name,
                'type' => "company",
                'search_id' => $company->id
            ]);
            if (auth()->attempt(['tin'=>$request->tin,'password'=>$request->password])){
                if ($request->category == 1){
                    return redirect(route('cfc'));
                }elseif ($request->category == 2){
                    return redirect(route('supplier'));
                }
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $address = Address::join('woredas','woredas.id','=','addresses.woreda_id')
                            ->join('zones','woredas.zone_id','=','zones.id')
                            ->join('regions','regions.id','=','zones.region_id')
                            ->select(['addresses.phone','addresses.special_name','woredas.name as woreda','zones.name as zone','regions.name as region'])
                            ->where('addresses.company_id',$company->id)->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showCfc',compact(['company','slides','logo','address']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
