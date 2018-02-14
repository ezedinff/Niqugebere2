<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzCardBuilder;
use App\EzBuilder\EzFormBuilder;
use App\ProductSubCategory;
use App\Supply;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supply = Supply::all();
        $inputs = [
            'photo' => ['product_photo'],
            'labels'=> ['product title','price','quantity','description'],
            'columns' => ['title','price','total_quantity','description'],
            'buttons' => [
                'edit' => 'cfc/supply',
                'delete' => 'cfc/supply',
            ]
        ];
        $title = "list of supplies";
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
        $action = "cfc/supply";
        $title = "post your new supply";
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
        Supply::create([
            'company_id'=> $company_id,
            'title'=>$request->title,
            'price'=>$request->price,
            'total_quantity' => $request->quantity,
            'product_sub_category_id' => $request->category,
            'description' => $request->description,
            'product_photo'=> "$uploadPath"
        ]);
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully posted your supply";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function show(Supply $supply)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function edit(Supply $supply)
    {
        $category = ProductSubCategory::find($supply->product_sub_category_id);
        $categories = ProductSubCategory::all();
        $inputs = [
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => $supply->title,
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
                'value' => $supply->price,
                'options' => ""
            ],
            [
                'type' => 'number',
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => $supply->total_quantity,
                'options' => ""
            ],
            [
                'type' => 'text',
                'name'=> 'description',
                'label' => 'description of the product if any',
                'value' => $supply->description
            ],
            [
                'type' => 'file'
            ]
        ];
        $action = "cfc/supply/".$supply->id;
        $title = "update your supply";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Supply  $supply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supply $supply)
    {
        $picture_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "uploads/".$picture_name;
        $supply->title = $request->title;
        $supply->price = $request->price;
        $supply->total_quantity = $request->quantity;
        $supply->product_sub_category_id = $request->category;
        $supply->product_photo =  $uploadPath;
        $supply->description = $request->description;
        $supply->save();
        $request->file->move(public_path('uploads'),$picture_name);
        $message = "you have successfully updated your supply";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();

    }

    public function destroy(Supply $supply)
    {
            try {
                $supply->delete();
                $message = "you have successfully deleted your supply";
                session()->regenerate();
                session()->flash('saved',$message);
            } catch (\Exception $e) {
            }
            return redirect()->back();
    }
}
