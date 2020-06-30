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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/encrypt/{instr}',function($instr)
	{
		return Hash::make($instr);
	});


Route::get('/sale', 'SaleController@index');
Route::get('/sale/{id}/post', 'SaleController@postOrder');
Route::post('/sale', 'SaleController@store');
Route::get('/sale/list','SaleController@saleList');
Route::get('sale/tobedeliver','SaleController@tobedeliver');
Route::get('/sale/{id}/print', 'SaleController@print');
Route::get('/sale/datewise','SaleController@DateWiseSale_Form');
Route::post('/sale/datewise','SaleController@DateWiseSale_Report');
Route::get('/sale/spricep', 'SaleController@SalePriceProductWise_Form');
Route::post('/sale/spricep', 'SaleController@SalePriceProductWise_Report');

Route::get('/dctracking','SaleController@DCTrackingWarehouseWise_Form');
Route::post('/dctracking','SaleController@DCTrackingWarehouseWise_Report');

Route::get('/sale/{id}/saledeliver', 'SaleController@saledeliver_form');
Route::post('/sale/{id}/update_delivered_status','SaleController@update_delivered_status');


Route::get('/reports','ReportsController@index');
Route::post('/reports/a','ReportsController@betweendates');
Route::get('/reports/full_stock','ReportsController@fullStock');

Route::get('/reports/pwledger','ReportsController@ProductWiseLedger_Form');

Route::post('/reports/pwledgerlist','ReportsController@ProductWiseLedger_Report');

Route::get('/reports/warehouses','ReportsController@WarehouseWiseStock_Form');
Route::post('/reports/warehousewisestock','ReportsController@WarehouseWiseStock_Report');
Route::get('/reports/reorder','ReportsController@Reorder');
Route::get('/reports/nearexpiry','ReportsController@NearExpiry');
Route::get('/reports/c_wise_p_sale','ReportsController@CustomerWiseProductSale_Form');
Route::post('/reports/c_wise_p_sale','ReportsController@CustomerWiseProductSale_Report');
Route::get('/reports/all_territory_wise_p_sale','ReportsController@AllTerritoryWiseProductSale_Form');
Route::post('/reports/all_territory_wise_p_sale','ReportsController@AllTerritoryWiseProductSale_Report');
Route::get('/reports/dcpw','ReportsController@DataComparisonProductWise_Form');
Route::post('/reports/dcpw','ReportsController@DataComparisonProductWise_Report');

Route::get('/reports/dccw','ReportsController@DataComparisonCustomerWise_Form');
Route::post('/reports/dccw','ReportsController@DataComparisonCustomerWise_Report');

Route::get('/reports/cwl','ReportsController@CutomerWiseLedger_Form');
Route::post('/reports/cwl','ReportsController@CutomerWiseLedger_Report');


Route::resource('user', 'UserController');
Route::get('/puser/{id}/pedit','UserController@ChangePassword_Form');
Route::PATCH('/puser/{id}','UserController@ChangePassword_Update');


Route::resource('vendor','VendorController');
Route::get('allvendors', 'VendorController@allvendors');
Route::resource('warehouse', 'WarehouseController');
Route::resource('company', 'CompanyController');
Route::get('allcompany', 'CompanyController@allcompanies');

Route::resource('customer', 'CustomerController');
Route::get('allcustomer', 'CustomerController@allcustomer');
Route::get('/product_list/{id}/list','CustomerproductController@CustomerProductList');
Route::get('/cppf','CustomerproductController@CustomerProductProfile_Form');
Route::post('/cppf/','CustomerproductController@CustomerProductProfile_Report');

Route::resource('product','ProductController');
Route::get('allproduct', 'ProductController@allproduct');

Route::resource('purchase', 'PurchaseController');
Route::resource('purchasedetail', 'PurchaseDetailController');
Route::get('/purchase/{id}/print','PurchaseController@print');

Route::resource('shipper', 'ShipperController');

Route::resource('order','OrderController');
Route::resource('orderdetail','OrderDetailController');
Route::get('/order/{id}/print', 'OrderController@print');
Route::get('/partialorders','OrderController@partialorders');
Route::get('/otracking','OrderController@OrderTrackingWarehouseWise_Form');
Route::post('/otracking','OrderController@OrderTrackingWarehouseWise_Report');
Route::get('/otdatewise','OrderController@OrderTrackingDateWise_Form');
Route::post('/otdatewise','OrderController@OrderTrackingDatwWise_Report');

Route::resource('pendingorder','PendingOrderController');
Route::resource('pendingorderdetail','PendingOrderDetailController');


Route::resource('customerproduct' , 'CustomerproductController');

Route::get('/salereturn','SaleReturnController@index');
Route::get('/salereturn/{id}/return_post', 'SaleReturnController@saleReturnPost');
Route::post('/salereturn', 'SaleReturnController@store');
Route::get('salereturn/list', 'SaleReturnController@SaleReturnList');
Route::get('srprint/{id}/print','SaleReturnController@SaleReturnPrint');


Route::resource('/payment','PaymentController');
Route::get('/getorder/{id}', 'PaymentController@GetOrdersAndTotalAmount');

Route::resource('/invoice','InvoiceController');
Route::get('/invoice/{id}/print', 'InvoiceController@print');
Route::resource('/invoicedetail', 'InvoiceDetailController');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::post('/filler/getpricebypid', 'FillerController@getPriceByProductID');
Route::post('/filler/getproductsbycustomer', 'FillerController@getProductsByCustomer');
Route::post('/filler/getstockbyproductid', 'FillerController@getStockByProductId');
Route::post('/filler/getMaxInvoiceNo', 'FillerController@getMaxInvoiceNo');

Route::get('/graph/bgmwise','GraphController@BarGraphMonthWiseForm');
Route::post('/graph/bgmwise','GraphController@BarGraphMonthWiseReport');
Route::get('/graph/bgqwise','GraphController@BarGraphQuarterWiseForm');
Route::post('/graph/bgqwise','GraphController@BarGraphQuarterWiseReport');
Route::get('/graph/bgywise','GraphController@BarGraphYearWiseForm');
Route::post('/graph/bgywise','GraphController@BarGraphYearWiseReport');
Route::get('/graph/bgtvwise','GraphController@BarGraphtTerritoryAndVendorWise_Form');
Route::post('/graph/bgtvwise','GraphController@BarGraphtTerritoryAndVendorWise_Report');

Route::get('/graph/piemwise','GraphController@PieGraphMonthWiseForm');
Route::post('/graph/piemwise','GraphController@PieGraphMonthWiseReport');
Route::get('/graph/pieqwise','GraphController@PieGraphQuarterWiseForm');
Route::post('/graph/pieqwise','GraphController@PieGraphQuarterWiseReport');
Route::get('/graph/pieywise','GraphController@PieGraphYearWiseForm');
Route::post('/graph/pieywise','GraphController@PieGraphYearWiseReport');


// Route::get('/correction','SaleController@correct_orders');