<?php
Route::get('/', function (){
    return redirect()->route('getDashboard');
});
Route::get('/login', ['as' => 'getLogin', 'uses' => 'AuthController@getLogin']);
Route::post('/login', ['as' => 'postLogin', 'uses' => 'AuthController@postLogin']);
Route::get('/logout', ['as' => 'postLogout', 'uses' => 'AuthController@postLogout']);

//Application

Route::group(['middleware' => 'auth'], function (){
    Route::group(['prefix' => 'api', 'namespace' => 'Api'], function (){
        Route::resource('role', 'RoleController');

        Route::get('type/search/{query}', 'SearchController@searchType');
        Route::get('manufacturer/search/{query}', 'SearchController@searchManufacturer');
        Route::get('product/search/{query}', 'SearchController@searchProduct');
        Route::get('product/nk/{query}', 'SearchController@searchNK');
        Route::get('customer/search/{query}', 'SearchController@searchCustomer');


        Route::resource('type', 'TypeController');
        Route::resource('manufacturer', 'ManufacturerController');
        Route::resource('supplier', 'SupplierController');
        Route::resource('customer', 'CustomerController');
        Route::post('product/search', ['as' => 'searchProduct', 'uses' => 'ProductController@search']);
        Route::resource('product', 'ProductController');
        Route::resource('quote', 'QuoteController');
        Route::resource('order', 'OrderController');
        Route::resource('payment', 'PaymentController');
        Route::resource('tax', 'TaxController');

        Route::get('permission', function (){
            return \App\Model\Permission::all();
        });
        Route::group(['namespace' => 'Warehouse'], function (){
            Route::resource('warehouse', 'WarehouseController');
            Route::resource('nk', 'PNKController');
            //Route::resource('status_nk', 'StatusNKController');
        });
    });
//    Route::get('test', 'TestController@index');

    Route::get('dashboard', ['as' => 'getDashboard', 'uses' => 'DashboardController@getDashboard']);

    Route::get('user-management', ['as' => 'userManagement', 'uses' => 'UserManagerController@index']);
    Route::get('role-management', ['as' => 'roleManagement', 'uses' => 'RoleManagerController@index']);
    Route::get('product-management', ['as' => 'productManagement', 'uses' => 'ProductController@index']);
    Route::get('type-management', ['as' => 'typeManagement', 'uses' => 'TypeController@index']);
    Route::get('manufacturer-management', ['as' => 'manufacturerManagement', 'uses' => 'ManufacturerController@index']);
    Route::get('supplier-management', ['as' => 'supplierManagement', 'uses' => 'SupplierController@index']);
    Route::get('customer-management', ['as' => 'customerManagement', 'uses' => 'CustomerController@index']);
    Route::get('product-management', ['as' => 'productManagement', 'uses' => 'ProductController@index']);
    Route::get('nk-management', ['as' => 'nkManagement', 'uses' => 'PNKController@index']);
    Route::get('xk-management', ['as' => 'xkManagement', 'uses' => 'PXKController@index']);
    Route::get('warehouse-management', ['as' => 'warehouseManagement', 'uses' => 'WarehouseController@index']);
    Route::get('quote-management', ['as' => 'quoteManagement', 'uses' => 'QuoteController@index']);
    Route::get('order-management', ['as' => 'orderManagement', 'uses' => 'OrderController@index']);
    Route::get('profile-management', ['as' => 'profileManagement', 'uses' => 'ProfileController@index']);

});





