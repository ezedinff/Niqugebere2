<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);
Route::get('/language/{lan}',array('Middleware' =>'LanguageMiddleware','uses'=>'LanguageController@store'));

Route::get('/', function () {
    if (app()->getLocale() == null){
        Illuminate\Support\Facades\Session::set("locale","en");
    }
    return view('welcome');
});

Auth::routes();
Route::get('/show-cfc/{company}','CompanyController@show');
Route::get('/market/{title}', 'PagesController@goToMarket');
Route::get('/get-subcategories','ProductSubCategoryController@getSubCategory');



Route::get('/zone','ZoneController@getZone');
Route::get('/woreda','WoredaController@getWoreda');
Route::post('/register-company','CompanyController@store');


Route::get('/home', 'HomeController@index');

Route::get('/admin/dashboard','UserController@admin')->name('admin');
Route::resource('/admin/zoneTranslation','ZoneTranslationController');
Route::resource('/admin/productSubCategory','ProductSubCategoryController');
Route::get('/admin/cfs','CompanyController@getFSC');
Route::get('/admin/suppliers','CompanyController@getSuppliers');



Route::get('/cfc','UserController@cfc')->name('cfc');
Route::resource('/cfc/inventory','InventoryController');
Route::resource('/cfc/supply','SupplyController');
Route::resource('/cfc/demand','DemandController');
Route::resource('/cfc/slide','SlideController');
Route::resource('/cfc/cover','CoverController');
Route::resource('/cfc/logo','LogoController');
Route::resource('/cfc/user','UserController');
Route::resource('/cfc/post','PostedProductController');
Route::resource('/cfc/subcategory','ProductSubCategoryController');
Route::get('cfc/i-can-deliver/{id}','DemandAggrementController@store');
Route::get('cfc/requests-to-deliver','DemandAggrementController@showForDemandPoster');
Route::get('cfc/accept-request/{agreement}','DemandAggrementController@accept');
Route::get('cfc/transporters-bid','TransportationBidController@index');
Route::get('cfc/accept-request-transporter/{transportationBid}','TransportationBidController@update');
Route::get('cfc/service',function (){
   return view('cfc.addService');
});
Route::get('/supplier','UserController@supplier')->name("supplier");
Route::resource('/supplier/product','InventoryController');
Route::get('/supplier/demands','DemandController@cfcDemand');



//transporter section
Route::get('/transporter','UserController@transporter')->name('transporter');
Route::resource('/transporter/vehicle','VehicleController');
Route::resource('/transporter/transportation','TransportationController');
Route::get('/transporter/get-customers-waiting-for-logistics','DemandAggrementController@index');
//Route::resource('/transporter/transportationBid','TransportationBidController');
Route::get('/transporter/transportationBid/create/{id}','TransportationBidController@create');
Route::post('/transporter/transportationBid/store/{id}','TransportationBidController@store');