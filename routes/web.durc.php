<?php
/*
This is an auto generated route file from DURC
this will be automatically overwritten by future DURC runs.


*/

 
//DURC->	aaaDurctest.author
Route::resource("/DURC/author", 'authorController');
Route::get("/DURC/json/author/{author_id}", 'authorController@jsonone');
Route::get("/DURC/json/author/", 'authorController@jsonall');
Route::get("/DURC/searchjson/author/", 'authorController@search');
 
//DURC->	aaaDurctest.author_book
Route::resource("/DURC/author_book", 'author_bookController');
Route::get("/DURC/json/author_book/{author_book_id}", 'author_bookController@jsonone');
Route::get("/DURC/json/author_book/", 'author_bookController@jsonall');
Route::get("/DURC/searchjson/author_book/", 'author_bookController@search');
 
//DURC->	aaaDurctest.authortype
Route::resource("/DURC/authortype", 'authortypeController');
Route::get("/DURC/json/authortype/{authortype_id}", 'authortypeController@jsonone');
Route::get("/DURC/json/authortype/", 'authortypeController@jsonall');
Route::get("/DURC/searchjson/authortype/", 'authortypeController@search');
 
//DURC->	aaaDurctest.book
Route::resource("/DURC/book", 'bookController');
Route::get("/DURC/json/book/{book_id}", 'bookController@jsonone');
Route::get("/DURC/json/book/", 'bookController@jsonall');
Route::get("/DURC/searchjson/book/", 'bookController@search');
 
//DURC->	aaaDurctest.comment
Route::resource("/DURC/comment", 'commentController');
Route::get("/DURC/json/comment/{comment_id}", 'commentController@jsonone');
Route::get("/DURC/json/comment/", 'commentController@jsonall');
Route::get("/DURC/searchjson/comment/", 'commentController@search');
 
//DURC->	aaaDurctest.donation
Route::resource("/DURC/donation", 'donationController');
Route::get("/DURC/json/donation/{donation_id}", 'donationController@jsonone');
Route::get("/DURC/json/donation/", 'donationController@jsonall');
Route::get("/DURC/searchjson/donation/", 'donationController@search');
 
//DURC->	aaaDurctest.foreignkeytestgizmo
Route::resource("/DURC/foreignkeytestgizmo", 'foreignkeytestgizmoController');
Route::get("/DURC/json/foreignkeytestgizmo/{foreignkeytestgizmo_id}", 'foreignkeytestgizmoController@jsonone');
Route::get("/DURC/json/foreignkeytestgizmo/", 'foreignkeytestgizmoController@jsonall');
Route::get("/DURC/searchjson/foreignkeytestgizmo/", 'foreignkeytestgizmoController@search');
 
//DURC->	aaaDurctest.foreignkeytestthingy
Route::resource("/DURC/foreignkeytestthingy", 'foreignkeytestthingyController');
Route::get("/DURC/json/foreignkeytestthingy/{foreignkeytestthingy_id}", 'foreignkeytestthingyController@jsonone');
Route::get("/DURC/json/foreignkeytestthingy/", 'foreignkeytestthingyController@jsonall');
Route::get("/DURC/searchjson/foreignkeytestthingy/", 'foreignkeytestthingyController@search');
 
//DURC->	aaaDurctest.funnything
Route::resource("/DURC/funnything", 'funnythingController');
Route::get("/DURC/json/funnything/{funnything_id}", 'funnythingController@jsonone');
Route::get("/DURC/json/funnything/", 'funnythingController@jsonall');
Route::get("/DURC/searchjson/funnything/", 'funnythingController@search');
 
//DURC->	aaaDurctest.post
Route::resource("/DURC/post", 'postController');
Route::get("/DURC/json/post/{post_id}", 'postController@jsonone');
Route::get("/DURC/json/post/", 'postController@jsonall');
Route::get("/DURC/searchjson/post/", 'postController@search');
 
//DURC->	aaaDurctest.sibling
Route::resource("/DURC/sibling", 'siblingController');
Route::get("/DURC/json/sibling/{sibling_id}", 'siblingController@jsonone');
Route::get("/DURC/json/sibling/", 'siblingController@jsonall');
Route::get("/DURC/searchjson/sibling/", 'siblingController@search');
 
//DURC->	aaaDurctest.test_boolean
Route::resource("/DURC/test_boolean", 'test_booleanController');
Route::get("/DURC/json/test_boolean/{test_boolean_id}", 'test_booleanController@jsonone');
Route::get("/DURC/json/test_boolean/", 'test_booleanController@jsonall');
Route::get("/DURC/searchjson/test_boolean/", 'test_booleanController@search');
 
//DURC->	aaaDurctest.test_created_only
Route::resource("/DURC/test_created_only", 'test_created_onlyController');
Route::get("/DURC/json/test_created_only/{test_created_only_id}", 'test_created_onlyController@jsonone');
Route::get("/DURC/json/test_created_only/", 'test_created_onlyController@jsonall');
Route::get("/DURC/searchjson/test_created_only/", 'test_created_onlyController@search');
 
//DURC->	aaaDurctest.test_soft_delete
Route::resource("/DURC/test_soft_delete", 'test_soft_deleteController');
Route::get("/DURC/json/test_soft_delete/{test_soft_delete_id}", 'test_soft_deleteController@jsonone');
Route::get("/DURC/json/test_soft_delete/", 'test_soft_deleteController@jsonall');
Route::get("/DURC/searchjson/test_soft_delete/", 'test_soft_deleteController@search');
Route::get("/DURC/test_soft_delete/restore/{id}", 'test_soft_deleteController@restore');
 
//DURC->	aaaDurctest.vote
Route::resource("/DURC/vote", 'voteController');
Route::get("/DURC/json/vote/{vote_id}", 'voteController@jsonone');
Route::get("/DURC/json/vote/", 'voteController@jsonall');
Route::get("/DURC/searchjson/vote/", 'voteController@search');
 
//DURC->	irs.nonprofitcorp
Route::resource("/DURC/nonprofitcorp", 'nonprofitcorpController');
Route::get("/DURC/json/nonprofitcorp/{nonprofitcorp_id}", 'nonprofitcorpController@jsonone');
Route::get("/DURC/json/nonprofitcorp/", 'nonprofitcorpController@jsonall');
Route::get("/DURC/searchjson/nonprofitcorp/", 'nonprofitcorpController@search');
 
//DURC->	northwind_data.inventoryTransaction
Route::resource("/DURC/inventorytransaction", 'inventorytransactionController');
Route::get("/DURC/json/inventorytransaction/{inventorytransaction_id}", 'inventorytransactionController@jsonone');
Route::get("/DURC/json/inventorytransaction/", 'inventorytransactionController@jsonall');
Route::get("/DURC/searchjson/inventorytransaction/", 'inventorytransactionController@search');
 
//DURC->	northwind_data.invoice
Route::resource("/DURC/invoice", 'invoiceController');
Route::get("/DURC/json/invoice/{invoice_id}", 'invoiceController@jsonone');
Route::get("/DURC/json/invoice/", 'invoiceController@jsonall');
Route::get("/DURC/searchjson/invoice/", 'invoiceController@search');
 
//DURC->	northwind_data.order
Route::resource("/DURC/order", 'orderController');
Route::get("/DURC/json/order/{order_id}", 'orderController@jsonone');
Route::get("/DURC/json/order/", 'orderController@jsonall');
Route::get("/DURC/searchjson/order/", 'orderController@search');
 
//DURC->	northwind_data.orderDetail
Route::resource("/DURC/orderdetail", 'orderdetailController');
Route::get("/DURC/json/orderdetail/{orderdetail_id}", 'orderdetailController@jsonone');
Route::get("/DURC/json/orderdetail/", 'orderdetailController@jsonall');
Route::get("/DURC/searchjson/orderdetail/", 'orderdetailController@search');
 
//DURC->	northwind_data.purchaseOrder
Route::resource("/DURC/purchaseorder", 'purchaseorderController');
Route::get("/DURC/json/purchaseorder/{purchaseorder_id}", 'purchaseorderController@jsonone');
Route::get("/DURC/json/purchaseorder/", 'purchaseorderController@jsonall');
Route::get("/DURC/searchjson/purchaseorder/", 'purchaseorderController@search');
 
//DURC->	northwind_data.purchaseOrderDetail
Route::resource("/DURC/purchaseorderdetail", 'purchaseorderdetailController');
Route::get("/DURC/json/purchaseorderdetail/{purchaseorderdetail_id}", 'purchaseorderdetailController@jsonone');
Route::get("/DURC/json/purchaseorderdetail/", 'purchaseorderdetailController@jsonall');
Route::get("/DURC/searchjson/purchaseorderdetail/", 'purchaseorderdetailController@search');
 
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
