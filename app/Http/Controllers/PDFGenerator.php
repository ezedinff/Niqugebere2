<?php

namespace App\Http\Controllers;

use App\EzBuilder\EzTableBuilder;
use App\EzBuilder\EzTableBuilder2;
use App\PurchasingRequest;
use App\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PDFGenerator extends Controller
{
        public function inventoryPdf(){
            $zones = Zone::all();
            $inputs = [
                'headers' => [
                    'FSC',
                    'subcategory',
                    'product name',
                    'phone',
                    'Region',
                    'Zone',
                    'Woreda',

                ],
                'columns' => [
                    'company',
                    'subcategory',
                    'product_name',
                    'phone',
                    'region',
                    'zone',
                    'woreda',
                ],
                'buttons' => [
                    'edit'=> "cfc/inventory",
                    'delete'=> "cfc/inventory"
                ]
            ];
            $title = "List of your inventories";
            $table = EzTableBuilder2::getTable($inputs,$zones);
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($table);
            return $pdf->stream();
        }
    public function purchase(){
        $inputs = [
            'headers' => [
                'FSC',
                'subcategory',
                'product name',
                'phone',
                'Region',
                'Zone',
                'Woreda',

            ],
            'columns' => [
                'company',
                'subcategory',
                'product_name',
                'phone',
                'region',
                'zone',
                'woreda',
            ],
            'buttons' => [
                'edit'=> "cfc/inventory",
                'delete'=> "cfc/inventory"
            ]
        ];
        $title = "List of your inventories";
        $table = EzTableBuilder2::getTable($inputs,self::getPurchase());
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($table);
        return $pdf->stream();

    }



    public function tableGeneratorForPurchase($purchases){

    }

    public function getPurchase(){
        $purchases = PurchasingRequest::join('product_sub_categories','purchasing_requests.product_sub_category_id','=','product_sub_categories.id')
            ->join('product_categories','product_categories.id','=','product_sub_categories.product_category_id')
            ->join('companies','companies.id','=','purchasing_requests.company_id')
            ->join('addresses','addresses.company_id','=','companies.id')
            ->join('woredas','woredas.id','=','addresses.woreda_id')
            ->join('zones','woredas.zone_id','=','zones.id')
            ->join('regions','regions.id','=','zones.region_id')
            ->select(['product_sub_categories.name as subcategory',
                'product_categories.name as category',
                'purchasing_requests.product_name',
                'purchasing_requests.quantity',
                'purchasing_requests.created_at',
                'woredas.name as woreda',
                'zones.name as zone',
                'regions.name as region',
                'addresses.phone as phone',
                'companies.name as  company'
            ])->get();
        return $purchases;
    }
}
