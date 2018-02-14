<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');

    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);

    });



    $api->get("get_categories","App\\Api\\V1\\Controllers\\CategoryController@getCategories");

    $api->get("partners","App\\Api\\V1\\Controllers\\PartnerController@getPartner");
    $api->get("get_cfsc","App\\Api\\V1\\Controllers\\CompanyController@show");
    $api->get("company_detail","App\\Api\\V1\\Controllers\\CompanyController@company_detail");
    $api->get("get_product","App\\Api\\V1\\Controllers\\CompanyDeliveringProductController@getCompanyProducts");
    $api->get("company_name","App\\Api\\V1\\Controllers\\CompanyController@getName");
    $api->get("companies_aboutus","App\\Api\\V1\\Controllers\\CompanyController@aboutUs");
    $api->get("companies_contactus","App\\Api\\V1\\Controllers\\AddressController@companyAddress");
    $api->get("posted_products","App\\Api\\V1\\Controllers\\PostedProductController@getPostedProduct");
    $api->post("company_product_order","App\\Api\\V1\\Controllers\\ProductRequestFormController@orders");
    $api->get("get_woreda","App\\Api\\V1\\Controllers\\WoredaTranslationController@get_woreda");
    $api->get("get_NearBy_Transporter","App\\Api\\V1\\Controllers\\CarOwnersPathController@getNearByTransporter");
    $api->get("car_type","App\\Api\\V1\\Controllers\\CarsTypeController@getCarTypes");
    $api->get("get_services","App\\Api\\V1\\Controllers\\ServiceCategoryController@getServices");
    $api->get("markets","App\\Api\\V1\\Controllers\\ProductCategoryController@markets");
    $api->get("market_category","App\\Api\\V1\\Controllers\\ProductSubCategoryController@getCategory");
    $api->get("posted_item_for_market","App\\Api\\V1\\Controllers\\PostedProductController@getMarketPost");

    $api->get("approval","App\\Api\\V1\\Controllers\\CompanyController@approval");
    $api->get("approve_request","App\\Api\\V1\\Controllers\\UserController@approveRequest");
    $api->get("fcm_token","App\\Api\\V1\\Controllers\\FirebaseTokenController@addToken");

    //pull starts here
    $api->get("pull","App\\Api\\V1\\Controllers\\SupplyController@getPull");
    //end of pull

    $api->group(['middleware' => 'api.auth'], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Access to protected resources granted! You are seeing this text as you provided the token correctly.'
            ]);
        });

        $api->get("check_verification","App\\Api\\V1\\Controllers\\UserController@checkVerification");
        $api->get("get_company","App\\Api\\V1\\Controllers\\UserController@getCompany");
        $api->post("upload_photo","App\\Api\\V1\\Controllers\\UserController@uploadCompanyLogo");
        $api->get("post_category","App\\Api\\V1\\Controllers\\ProductSubCategoryController@getPostCategory");

        //cfsc start hers
        $api->get("cfsc_profile","App\\Api\\V1\\Controllers\\CompanyController@profile");
        $api->post("upload_cfsc_profile","App\\Api\\V1\\Controllers\\CompanyController@uploadProfile");
        $api->get("update_description","App\\Api\\V1\\Controllers\\CompanyController@description");
        $api->get("product_selection","App\\Api\\V1\\Controllers\\ProductCategoryController@productSelection");
        $api->get("update_product_selection","App\\Api\\V1\\Controllers\\CompanyDeliveringProductController@companyProvidingProducts");
        $api->get("supply","App\\Api\\V1\\Controllers\\SupplyController@supplies");
        $api->get("supply_request","App\\Api\\V1\\Controllers\\SupplyResultController@supplyRequest");
        $api->get("get_product_category","App\\Api\\V1\\Controllers\\ProductCategoryController@getProductCateogry");
        $api->get("get_sub_product_category","App\\Api\\V1\\Controllers\\ProductSubCategoryController@getSubCategories");
        $api->post("post_supply","App\\Api\\V1\\Controllers\\SupplyController@postSupply");
        $api->get("show_supply","App\\Api\\V1\\Controllers\\SupplyController@showSupply");
        $api->get("my_supply_request","App\\Api\\V1\\Controllers\\SupplyController@mySupplyRequest");
        $api->get("supply_requester","App\\Api\\V1\\Controllers\\SupplyController@supplyRequester");
        $api->get("single_supply_request","App\\Api\\V1\\Controllers\\SupplyController@singleSupply");
        $api->get("demands","App\\Api\\V1\\Controllers\\DemandController@getDemands");
        $api->post("demand_post","App\\Api\\V1\\Controllers\\DemandController@postDemand");
        $api->post("send_inventory","App\\Api\\V1\\Controllers\\InventoryController@postInventory");
        $api->get("my_payment","App\\Api\\V1\\Controllers\\InventoryPaymentController@myPayment");
        //cfsc ends here


        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);

    });



});