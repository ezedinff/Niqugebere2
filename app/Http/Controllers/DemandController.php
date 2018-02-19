<?php

namespace App\Http\Controllers;

use App\Demand;
use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzCardBuilder;
use App\ProductSubCategory;
use Illuminate\Http\Request;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supply = Demand::all();
        $inputs = [
            'photo' => ['product_photo'],
            'labels'=> ['product title','price','quantity','description'],
            'columns' => ['title','price','total_quantity','description'],
            'buttons' => [
                'edit' => 'cfc/demand',
                'delete' => 'cfc/demand',
            ]
        ];
        $title = "list of demands";
        $card = EzCardBuilder::getCard($inputs,$supply);
        return view('cfc.supplies',compact(['card','title']));
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
        $uploadPath = "public/uploads/".$picture_name;
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
        return view('cfc.showDemand',compact('demand'));
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
        $uploadPath = "public/uploads/".$picture_name;
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
