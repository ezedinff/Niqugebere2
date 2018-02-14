<?php

namespace App\Api\V1\Controllers;

use App\Demand;
use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzCardBuilder;
use App\ProductSubCategory;
use Dingo\Api\Http\Request;
use JWTAuth;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function postDemand(Request $request){
        $currentuser= JWTAuth::parseToken()->authenticate();

        $file_name = time().'.'.$request->file->getClientOriginalExtension();
        $post_supply=new Demand();
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
            return response()->json([
                'status' =>'ok',
                'token' => "ok"
            ], 201);
        }
    }
    public function getDemands()
    {
        $currentuser= JWTAuth::parseToken()->authenticate();

        $supply=Demand::join("companies",'companies.id','demands.company_id')
            ->join('product_sub_categories','product_sub_categories.id','demands.product_sub_category_id')
            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
            ->where("demands.company_id","!=",$currentuser->company_id)
            ->select("demands.id","companies.name as company_name","companies.photo_path as company_photo","product_categories.name as category_name","product_sub_categories.name as sub_category_name","demands.title","demands.product_photo","demands.price","demands.total_quantity","demands.availability","demands.description")->get();

        return response()->json($supply);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductSubCategory::all();
        $inputs = [
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => '',
                'options'=> ""
            ],
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => '',
                'options'=> $category
            ],
            [
                'type' => 'number',
                'name'=> 'price',
                'label' => 'price',
                'value' => '',
                'options' => ""
            ],
            [
                'type' => 'number',
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => '',
                'options' => ""
            ],
            [
                'type' => 'text',
                'name'=> 'description',
                'label' => 'description of the product if any',
                'value' => ''
            ],
            [
                'type' => 'file'
            ]
        ];
        $action = "cfc/demand";
        $title = "post your new demand";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $company_id = auth()->user()->company_id;
        Demand::create([
            'company_id'=> $company_id,
            'title'=>$request->title,
            'price'=>$request->price,
            'total_quantity' => $request->quantity,
            'product_sub_category_id' => $request->category,
            'description' => $request->description,
            'product_photo'=> "$uploadPath"
        ]);
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully posted your demand";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        $category = ProductSubCategory::find($demand->product_sub_category_id);
        $categories = ProductSubCategory::all();
        $inputs = [
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => $demand->title,
                'options'=> ""
            ],
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => $category,
                'options'=> $categories
            ],
            [
                'type' => 'number',
                'name'=> 'price',
                'label' => 'price',
                'value' => $demand->price,
                'options' => ""
            ],
            [
                'type' => 'number',
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => $demand->total_quantity,
                'options' => ""
            ],
            [
                'type' => 'text',
                'name'=> 'description',
                'label' => 'description of the product if any',
                'value' => $demand->description
            ],
            [
                'type' => 'file'
            ]
        ];
        $action = "cfc/demand/".$demand->id;
        $title = "update your demand";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demand $demand)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $demand->title = $request->title;
        $demand->price = $request->price;
        $demand->total_quantity = $request->quantity;
        $demand->product_sub_category_id = $request->category;
        $demand->product_photo =  $uploadPath;
        $demand->description = $request->description;
        $demand->save();
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully updated your demand";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        try {
            $demand->delete();
            $message = "you have successfully deleted your demand";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
