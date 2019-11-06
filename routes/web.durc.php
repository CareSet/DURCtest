<?php
/*
This is an auto generated route file from DURC
this will be automatically overwritten by future DURC runs.


*/

 
//DURC->	northwind_model.appstring
Route::resource("/DURC/appstring", 'appstringController');
Route::get("/DURC/json/appstring/{appstring_id}", 'appstringController@jsonone');
Route::get("/DURC/json/appstring/", 'appstringController@jsonall');
Route::get("/DURC/searchjson/appstring/", 'appstringController@search');

 
//DURC->	northwind_model.customer
Route::resource("/DURC/customer", 'customerController');
Route::get("/DURC/json/customer/{customer_id}", 'customerController@jsonone');
Route::get("/DURC/json/customer/", 'customerController@jsonall');
Route::get("/DURC/searchjson/customer/", 'customerController@search');
Route::get("/DURC/customer/restore/{id}", 'customerController@restore');
 
//DURC->	northwind_model.employee
Route::resource("/DURC/employee", 'employeeController');
Route::get("/DURC/json/employee/{employee_id}", 'employeeController@jsonone');
Route::get("/DURC/json/employee/", 'employeeController@jsonall');
Route::get("/DURC/searchjson/employee/", 'employeeController@search');

 
//DURC->	northwind_model.employeePrivilege
Route::resource("/DURC/employeeprivilege", 'employeeprivilegeController');
Route::get("/DURC/json/employeeprivilege/{employeeprivilege_id}", 'employeeprivilegeController@jsonone');
Route::get("/DURC/json/employeeprivilege/", 'employeeprivilegeController@jsonall');
Route::get("/DURC/searchjson/employeeprivilege/", 'employeeprivilegeController@search');

 
//DURC->	northwind_model.inventoryTransactionType
Route::resource("/DURC/inventorytransactiontype", 'inventorytransactiontypeController');
Route::get("/DURC/json/inventorytransactiontype/{inventorytransactiontype_id}", 'inventorytransactiontypeController@jsonone');
Route::get("/DURC/json/inventorytransactiontype/", 'inventorytransactiontypeController@jsonall');
Route::get("/DURC/searchjson/inventorytransactiontype/", 'inventorytransactiontypeController@search');

 
//DURC->	northwind_model.orderDetailStat
Route::resource("/DURC/orderdetailstat", 'orderdetailstatController');
Route::get("/DURC/json/orderdetailstat/{orderdetailstat_id}", 'orderdetailstatController@jsonone');
Route::get("/DURC/json/orderdetailstat/", 'orderdetailstatController@jsonall');
Route::get("/DURC/searchjson/orderdetailstat/", 'orderdetailstatController@search');

 
//DURC->	northwind_model.orderStat
Route::resource("/DURC/orderstat", 'orderstatController');
Route::get("/DURC/json/orderstat/{orderstat_id}", 'orderstatController@jsonone');
Route::get("/DURC/json/orderstat/", 'orderstatController@jsonall');
Route::get("/DURC/searchjson/orderstat/", 'orderstatController@search');

 
//DURC->	northwind_model.orderTaxStat
Route::resource("/DURC/ordertaxstat", 'ordertaxstatController');
Route::get("/DURC/json/ordertaxstat/{ordertaxstat_id}", 'ordertaxstatController@jsonone');
Route::get("/DURC/json/ordertaxstat/", 'ordertaxstatController@jsonall');
Route::get("/DURC/searchjson/ordertaxstat/", 'ordertaxstatController@search');

 
//DURC->	northwind_model.privilege
Route::resource("/DURC/privilege", 'privilegeController');
Route::get("/DURC/json/privilege/{privilege_id}", 'privilegeController@jsonone');
Route::get("/DURC/json/privilege/", 'privilegeController@jsonall');
Route::get("/DURC/searchjson/privilege/", 'privilegeController@search');

 
//DURC->	northwind_model.product
Route::resource("/DURC/product", 'productController');
Route::get("/DURC/json/product/{product_id}", 'productController@jsonone');
Route::get("/DURC/json/product/", 'productController@jsonall');
Route::get("/DURC/searchjson/product/", 'productController@search');

 
//DURC->	northwind_model.purchaseOrderStat
Route::resource("/DURC/purchaseorderstat", 'purchaseorderstatController');
Route::get("/DURC/json/purchaseorderstat/{purchaseorderstat_id}", 'purchaseorderstatController@jsonone');
Route::get("/DURC/json/purchaseorderstat/", 'purchaseorderstatController@jsonall');
Route::get("/DURC/searchjson/purchaseorderstat/", 'purchaseorderstatController@search');

 
//DURC->	northwind_model.salesReport
Route::resource("/DURC/salesreport", 'salesreportController');
Route::get("/DURC/json/salesreport/{salesreport_id}", 'salesreportController@jsonone');
Route::get("/DURC/json/salesreport/", 'salesreportController@jsonall');
Route::get("/DURC/searchjson/salesreport/", 'salesreportController@search');

 
//DURC->	northwind_model.shipper
Route::resource("/DURC/shipper", 'shipperController');
Route::get("/DURC/json/shipper/{shipper_id}", 'shipperController@jsonone');
Route::get("/DURC/json/shipper/", 'shipperController@jsonall');
Route::get("/DURC/searchjson/shipper/", 'shipperController@search');

 
//DURC->	northwind_model.supplier
Route::resource("/DURC/supplier", 'supplierController');
Route::get("/DURC/json/supplier/{supplier_id}", 'supplierController@jsonone');
Route::get("/DURC/json/supplier/", 'supplierController@jsonall');
Route::get("/DURC/searchjson/supplier/", 'supplierController@search');

