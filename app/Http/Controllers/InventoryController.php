<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzTableBuilder;
use App\Inventory;
use App\ProductSubCategory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones  = Inventory::join('product_sub_categories','inventories.product_sub_category_id','=','product_sub_categories.id')
                            ->select(['inventories.product_name','inventories.id','inventories.quantity','product_sub_categories.name'])
                            ->where('company_id',auth()->user()->company_id)->get();
        $inputs = [
            'headers' => [
                'product category',
                'product name',
                'quantity'
            ],
            'columns' => [
                'name',
                'product_name',
                'quantity',
            ],
            'buttons' => [
                'edit'=> "cfc/inventory",
                'delete'=> "cfc/inventory"
            ]
        ];
        $title = "List of your inventories";
        $table = EzTableBuilder::getTable($inputs,$zones);
        return view('cfc.displayTemplate',compact(['table','title']));
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
        ];
        $action = "cfc/inventory";
        $title = "Add new product to your inventory";
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
        Inventory::create([
            'company_id'=> auth()->user()->company_id,
            'product_sub_category_id' => $request->category,
            'product_name'=>$request->title,
            'quantity' => $request->quantity,

        ]);


        $message = "you have successfully submitted your invetories. your coin keep growing";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        $category = ProductSubCategory::find($inventory->product_sub_category_id);
        $categories = ProductSubCategory::all();
        $inputs = [
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => $inventory->product_name,
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
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => $inventory->quantity,
                'options' => ""
            ],
        ];
        $action = "cfc/inventory";
        $title = "Add new product to your inventory";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        $inventory->title = $request->title;
        $inventory->price = $request->price;
        $inventory->total_quantity = $request->quantity;
        $inventory->product_sub_category_id = $request->category;;
        $inventory->save();
        $message = "you have successfully updated your inventory";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        try {
            $inventory->delete();
            $message = "you have successfully deleted from your inventory catalog";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
