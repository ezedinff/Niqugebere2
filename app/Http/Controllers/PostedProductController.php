<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzCardBuilder;
use App\EzBuilder\EzFormBuilder;
use App\posted_product;
use App\ProductCategory;
use App\ProductSubCategory;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Symfony\Component\Console\Helper\Table;

class PostedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = posted_product::where('company_id',auth()->user()->company_id)->get();
        $inputs = [
            'photo' => ['product_photo'],
            'labels'=> ['Product name','Price','Quantity'],
            'columns' => ['product_name','unit_price','quantity'],
            'buttons' => [
                'edit' => 'cfc/post',
                'delete' => 'cfc/post',
            ]
        ];
        $title = "List of your posted products in the market";
        $card = EzCardBuilder::getCard($inputs,$posts);
        return view('cfc.supplies',compact(['card','title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = ProductCategory::all();
        $units = \App\unit::all();
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => '',
                'options'=> $category
            ],
            [
                'type' => 'select',
                'name'=> 'subcategory',
                'label' => 'product sub category',
                'value' => '',
                'options'=> ''
            ],
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => '',
                'options'=> ""
            ],
            [
                'type' => 'select',
                'name'=> 'unit',
                'label' => 'unit',
                'value' => '',
                'options'=> $units
            ],
            [
                'type' => 'number',
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => '',
                'options' => ""
            ],
            [
                'type' => 'number',
                'name'=> 'price',
                'label' => 'Price',
                'value' => '',
                'options' => ""
            ],
            [
                'type' => 'file'
            ]

        ];
        $action = "cfc/post";
        $title = "post your items to the market";
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
        $pictures_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "public/uploads/".$pictures_name;
        $request->file->move(public_path('uploads'), $pictures_name);
        posted_product::create([
            'company_id' => auth()->user()->company_id,
            'product_sub_category_id' => $request->subcategory,
            'product_name' => $request->title,
            'unit_id' => $request->unit,
            'quantity' => $request->quantity,
            'unit_price'=> $request->price,
            'product_photo' => $uploadPath
        ]);
        $message = "you have successfully posted your product into the market";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\posted_product  $posted_product
     * @return \Illuminate\Http\Response
     */
    public function show(posted_product $posted_product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\posted_product  $posted_product
     * @return \Illuminate\Http\Response
     */
    public function edit(posted_product $post)
    {
        $sb = ProductSubCategory::find($post->product_sub_category_id);
        $c = ProductCategory::find($sb->product_category_id);
        $category = ProductCategory::all();
        $units = \App\unit::all();
        $inputs = [
            [
                'type' => 'select',
                'name'=> 'category',
                'label' => 'product category',
                'value' => $c,
                'options'=> $category
            ],
            [
                'type' => 'select',
                'name'=> 'subcategory',
                'label' => 'product sub category',
                'value' => $sb,
                'options'=> ProductSubCategory::all()
            ],
            [
                'type' => 'text',
                'name'=> 'title',
                'label' => 'name of the product',
                'value' => $post->product_name,
                'options'=> ""
            ],
            [
                'type' => 'select',
                'name'=> 'unit',
                'label' => 'unit',
                'value' => \App\unit::find($post->unit_id),
                'options'=> $units
            ],
            [
                'type' => 'number',
                'name'=> 'quantity',
                'label' => 'Quantity',
                'value' => $post->quantity,
                'options' => ""
            ],
            [
                'type' => 'number',
                'name'=> 'price',
                'label' => 'Price',
                'value' => $post->unit_price,
                'options' => ""
            ],
            [
                'type' => 'file'
            ]

        ];
        $action = "cfc/post/".$post->id;
        $title = "update your post";
        $form =  EzFormBuilder::getForm($inputs,$action, "PATCH");
        return view('cfc.formTemplate',compact(['form','title']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\posted_product  $posted_product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, posted_product $post)
    {
        $pictures_name = time().'.'.$request->file->getClientOriginalExtension();
        $uploadPath = "public/uploads/".$pictures_name;
        $request->file->move(public_path('uploads'), $pictures_name);
        $post->product_sub_category_id = $request->subcategory;
        $post->product_name = $request->title;
        $post->unit_id = $request->unit;
        $post->quantity = $request->quantity;
        $post->unit_price = $request->price;
        $post->product_photo =$uploadPath;
        $post->save();
        $message = "you have successfully updated the your post";
        session()->regenerate();
        session()->flash('saved',$message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\posted_product  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(posted_product $post)
    {

        try {
            $post->delete();
            $message = "you have successfully deleted your post";
            session()->regenerate();
            session()->flash('saved',$message);
        } catch (\Exception $e) {
        }
        return redirect()->back();
    }
}
