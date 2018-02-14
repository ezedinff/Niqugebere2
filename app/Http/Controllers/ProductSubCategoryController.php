<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzFormBuilder;
use App\EzBuilder\EzTableBuilder;
use App\ProductCategory;
use App\ProductSubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{

    public function getSubCategory(Request $request){
        $subcategory = ProductSubCategory::where('product_category_id',$request->id)->get()->toArray();
        return $subcategory;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSubCategory
            = ProductSubCategory::join('product_categories','product_categories.id','product_sub_categories.product_category_id')
                                ->select(['product_sub_categories.id','product_sub_categories.name','product_categories.name as category'])->get();

       $inputs = [
            'headers' => [
                'sub category',
                'category'
            ],
            'columns' => [
                'name',
                'category',
            ],
            'buttons' => [
                'edit'=> "admin/productSubCategory",
                'delete'=> "admin/productSubCategory"
            ]
        ];
       $create = 'admin/productSubCategory/create';
        $title = "List of sub categories and their respective category";
        $table = EzTableBuilder::getTable($inputs,$productSubCategory);
        return view('admin.displayTemplate',compact(['table','title','create']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => "",
                'options'=> $category
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'Name of the sub category',
                'value' => "",
                'options' => ""
            ]
        ];
        $action = "admin/productSubCategory";
        $title = "Add new sub category into the system";
        $form =  EzFormBuilder::getForm($inputs,$action, "POST");
        return view('admin.formTemplate',compact(['form','title']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorName = ProductCategory::find($request->category);
        ProductSubCategory::create([
           'product_category_id' => $request->category,
           'name' => $request->name
        ]);
        $message = "you have successfully added new sub category for " . $categorName->name;
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSubCategory $productSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSubCategory $productSubCategory)
    {
        $category = ProductCategory::all();
        $selectedCateggory = ProductCategory::find($productSubCategory->product_category_id);
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => $selectedCateggory,
                'options'=> $category
            ],
            [
                'type' => 'text',
                'name'=> 'name',
                'label' => 'Name of the sub category',
                'value' => $productSubCategory->name,
                'options' => ""
            ]
        ];
        $action = "admin/productSubCategory/".$productSubCategory->id;
        $title = "edit the sub category";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('admin.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSubCategory $productSubCategory)
    {

        $productSubCategory->product_category_id = $request->category;
        $productSubCategory->name = $request->name;
        $productSubCategory->save();
        $message = "you have successfully updated the sub category";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSubCategory  $productSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSubCategory $productSubCategory)
    {
        try {
            $productSubCategory->delete();
            $message = "you have successfully deleted the sub category";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
