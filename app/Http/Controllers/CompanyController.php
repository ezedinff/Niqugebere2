<?php

namespace App\Http\Controllers;

use App\About;
use App\Address;
use App\Company;
use App\Logo;
use App\News;
use App\posted_product;
use App\Searchable;
use App\Service;
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
    public function showProductsCategory(Company $company){
        $product_categories = posted_product::join('product_sub_categories','product_sub_categories.id','=','posted_products.product_sub_category_id')
                                            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
                                            ->where('posted_products.company_id',$company->id)
                                            ->groupBy('product_categories.name')
                                            ->select(['product_categories.name','product_categories.product_photo'])
                                            ->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showProductCategory',compact(['company','product_categories','slides','logo']));
    }
    public function showProducts(Company $company,$title){
        $products = posted_product::join('product_sub_categories','product_sub_categories.id','=','posted_products.product_sub_category_id')
            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
            ->select(['posted_products.product_photo','posted_products.quantity','posted_products.unit_price','posted_products.product_name'])
            ->where(['posted_products.company_id' => $company->id , 'product_categories.name' => $title])->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showProducts',compact(['company','products','slides','logo']));
    }
    public function showServiceCategory(Company $company)
    {
        $service_categories = Service::join('service_categories','service_categories.id','=','services.service_category_id')
                                    ->where('services.company_id',$company->id)
                                    ->groupBy('service_categories.name')
                                    ->select('service_categories.name')
                                    ->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showServiceCategory',compact(['service_categories','company','slides','logo']));
    }

    public function showServices(Company $company, $title)
    {
        $services = Service::join('service_categories','service_categories.id','=','services.service_category_id')
            ->select(['services.title','services.description','services.created_at','services.id'])
            ->where(['services.company_id' => $company->id,'service_categories.name' => $title])->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showServices',compact(['company','services','slides','logo']));
    }
    public function showAbout(Company $company){
        $about = About::where('company_id',$company->id)->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showAbout',compact(['company','about','slides','logo']));
    }
    public function showContact(Company $company){
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        $title = "Contact us";
        return view('showContact',compact(['company','slides','logo','title']));
    }
    public function showNews(Company $company){
        $news = News::where('company_id',$company->id)->get();
        $slides = Slide::where('company_id',$company->id)->get();
        $logo = Logo::where('company_id',$company->id)->get();
        return view('showNews',compact(['news','company','slides','logo']));
    }

    /*
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
