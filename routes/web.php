<?php
///*
//This is an auto generated route file from DURC
//this will be automatically overwritten by future DURC runs.
//
//DURC Generated At: Monday 1st of January 2018 04:58:04 PM
//
//*/
//
//
////DURC->	aaaDurctest.author
//Route::resource('/DURC/author', 'authorController');
//Route::get('/DURCjson/author/{author_id}', 'authorController@jsonone');
//Route::get('/DURCjson/author/', 'authorController@jsonall');
//Route::get('/DURCsearchjson/author/', 'authorController@search');
//
////DURC->	aaaDurctest.author_book
//Route::resource('/DURC/author_book', 'author_bookController');
//Route::get('/DURCjson/author_book/{author_book_id}', 'author_bookController@jsonone');
//Route::get('/DURCjson/author_book/', 'author_bookController@jsonall');
//Route::get('/DURCsearchjson/author_book/', 'author_bookController@search');
//
////DURC->	aaaDurctest.authortype
//Route::resource('/DURC/authortype', 'authortypeController');
//Route::get('/DURCjson/authortype/{authortype_id}', 'authortypeController@jsonone');
//Route::get('/DURCjson/authortype/', 'authortypeController@jsonall');
//Route::get('/DURCsearchjson/authortype/', 'authortypeController@search');
//
////DURC->	aaaDurctest.book
//Route::resource('/DURC/book', 'bookController');
//Route::get('/DURCjson/book/{book_id}', 'bookController@jsonone');
//Route::get('/DURCjson/book/', 'bookController@jsonall');
//Route::get('/DURCsearchjson/book/', 'bookController@search');
//
////DURC->	aaaDurctest.comment
//Route::resource('/DURC/comment', 'commentController');
//Route::get('/DURCjson/comment/{comment_id}', 'commentController@jsonone');
//Route::get('/DURCjson/comment/', 'commentController@jsonall');
//Route::get('/DURCsearchjson/comment/', 'commentController@search');
//
////DURC->	aaaDurctest.donation
//Route::resource('/DURC/donation', 'donationController');
//Route::get('/DURCjson/donation/{donation_id}', 'donationController@jsonone');
//Route::get('/DURCjson/donation/', 'donationController@jsonall');
//Route::get('/DURCsearchjson/donation/', 'donationController@search');
//
////DURC->	aaaDurctest.foreignkeytestgizmo
//Route::resource('/DURC/foreignkeytestgizmo', 'foreignkeytestgizmoController');
//Route::get('/DURCjson/foreignkeytestgizmo/{foreignkeytestgizmo_id}', 'foreignkeytestgizmoController@jsonone');
//Route::get('/DURCjson/foreignkeytestgizmo/', 'foreignkeytestgizmoController@jsonall');
//Route::get('/DURCsearchjson/foreignkeytestgizmo/', 'foreignkeytestgizmoController@search');
//
////DURC->	aaaDurctest.foreignkeytestthingy
//Route::resource('/DURC/foreignkeytestthingy', 'foreignkeytestthingyController');
//Route::get('/DURCjson/foreignkeytestthingy/{foreignkeytestthingy_id}', 'foreignkeytestthingyController@jsonone');
//Route::get('/DURCjson/foreignkeytestthingy/', 'foreignkeytestthingyController@jsonall');
//Route::get('/DURCsearchjson/foreignkeytestthingy/', 'foreignkeytestthingyController@search');
//
////DURC->	aaaDurctest.funnything
//Route::resource('/DURC/funnything', 'funnythingController');
//Route::get('/DURCjson/funnything/{funnything_id}', 'funnythingController@jsonone');
//Route::get('/DURCjson/funnything/', 'funnythingController@jsonall');
//Route::get('/DURCsearchjson/funnything/', 'funnythingController@search');
//
////DURC->	aaaDurctest.post
//Route::resource('/DURC/post', 'postController');
//Route::get('/DURCjson/post/{post_id}', 'postController@jsonone');
//Route::get('/DURCjson/post/', 'postController@jsonall');
//Route::get('/DURCsearchjson/post/', 'postController@search');
//
////DURC->	aaaDurctest.sibling
//Route::resource('/DURC/sibling', 'siblingController');
//Route::get('/DURCjson/sibling/{sibling_id}', 'siblingController@jsonone');
//Route::get('/DURCjson/sibling/', 'siblingController@jsonall');
//Route::get('/DURCsearchjson/sibling/', 'siblingController@search');
//
////DURC->	aaaDurctest.vote
//Route::resource('/DURC/vote', 'voteController');
//Route::get('/DURCjson/vote/{vote_id}', 'voteController@jsonone');
//Route::get('/DURCjson/vote/', 'voteController@jsonall');
//Route::get('/DURCsearchjson/vote/', 'voteController@search');
//
////DURC->	irs.nonprofitcorp
//Route::resource('/DURC/nonprofitcorp', 'nonprofitcorpController');
//Route::get('/DURCjson/nonprofitcorp/{nonprofitcorp_id}', 'nonprofitcorpController@jsonone');
//Route::get('/DURCjson/nonprofitcorp/', 'nonprofitcorpController@jsonall');
//Route::get('/DURCsearchjson/nonprofitcorp/', 'nonprofitcorpController@search');
//
////DURC->	northwind_data.inventoryTransaction
//Route::resource('/DURC/inventorytransaction', 'inventorytransactionController');
//Route::get('/DURCjson/inventorytransaction/{inventorytransaction_id}', 'inventorytransactionController@jsonone');
//Route::get('/DURCjson/inventorytransaction/', 'inventorytransactionController@jsonall');
//Route::get('/DURCsearchjson/inventorytransaction/', 'inventorytransactionController@search');
//
////DURC->	northwind_data.invoice
//Route::resource('/DURC/invoice', 'invoiceController');
//Route::get('/DURCjson/invoice/{invoice_id}', 'invoiceController@jsonone');
//Route::get('/DURCjson/invoice/', 'invoiceController@jsonall');
//Route::get('/DURCsearchjson/invoice/', 'invoiceController@search');
//
////DURC->	northwind_data.order
//Route::resource('/DURC/order', 'orderController');
//Route::get('/DURCjson/order/{order_id}', 'orderController@jsonone');
//Route::get('/DURCjson/order/', 'orderController@jsonall');
//Route::get('/DURCsearchjson/order/', 'orderController@search');
//
////DURC->	northwind_data.orderDetail
//Route::resource('/DURC/orderdetail', 'orderdetailController');
//Route::get('/DURCjson/orderdetail/{orderdetail_id}', 'orderdetailController@jsonone');
//Route::get('/DURCjson/orderdetail/', 'orderdetailController@jsonall');
//Route::get('/DURCsearchjson/orderdetail/', 'orderdetailController@search');
//
////DURC->	northwind_data.purchaseOrder
//Route::resource('/DURC/purchaseorder', 'purchaseorderController');
//Route::get('/DURCjson/purchaseorder/{purchaseorder_id}', 'purchaseorderController@jsonone');
//Route::get('/DURCjson/purchaseorder/', 'purchaseorderController@jsonall');
//Route::get('/DURCsearchjson/purchaseorder/', 'purchaseorderController@search');
//
////DURC->	northwind_data.purchaseOrderDetail
//Route::resource('/DURC/purchaseorderdetail', 'purchaseorderdetailController');
//Route::get('/DURCjson/purchaseorderdetail/{purchaseorderdetail_id}', 'purchaseorderdetailController@jsonone');
//Route::get('/DURCjson/purchaseorderdetail/', 'purchaseorderdetailController@jsonall');
//Route::get('/DURCsearchjson/purchaseorderdetail/', 'purchaseorderdetailController@search');
//
////DURC->	northwind_model.appstring
//Route::resource('/DURC/appstring', 'appstringController');
//Route::get('/DURCjson/appstring/{appstring_id}', 'appstringController@jsonone');
//Route::get('/DURCjson/appstring/', 'appstringController@jsonall');
//Route::get('/DURCsearchjson/appstring/', 'appstringController@search');
//
////DURC->	northwind_model.customer
//Route::resource('/DURC/customer', 'customerController');
//Route::get('/DURCjson/customer/{customer_id}', 'customerController@jsonone');
//Route::get('/DURCjson/customer/', 'customerController@jsonall');
//Route::get('/DURCsearchjson/customer/', 'customerController@search');
//
////DURC->	northwind_model.employee
//Route::resource('/DURC/employee', 'employeeController');
//Route::get('/DURCjson/employee/{employee_id}', 'employeeController@jsonone');
//Route::get('/DURCjson/employee/', 'employeeController@jsonall');
//Route::get('/DURCsearchjson/employee/', 'employeeController@search');
//
////DURC->	northwind_model.employeePrivilege
//Route::resource('/DURC/employeeprivilege', 'employeeprivilegeController');
//Route::get('/DURCjson/employeeprivilege/{employeeprivilege_id}', 'employeeprivilegeController@jsonone');
//Route::get('/DURCjson/employeeprivilege/', 'employeeprivilegeController@jsonall');
//Route::get('/DURCsearchjson/employeeprivilege/', 'employeeprivilegeController@search');
//
////DURC->	northwind_model.inventoryTransactionType
//Route::resource('/DURC/inventorytransactiontype', 'inventorytransactiontypeController');
//Route::get('/DURCjson/inventorytransactiontype/{inventorytransactiontype_id}', 'inventorytransactiontypeController@jsonone');
//Route::get('/DURCjson/inventorytransactiontype/', 'inventorytransactiontypeController@jsonall');
//Route::get('/DURCsearchjson/inventorytransactiontype/', 'inventorytransactiontypeController@search');
//
////DURC->	northwind_model.orderDetailStatus
//Route::resource('/DURC/orderdetailstatus', 'orderdetailstatusController');
//Route::get('/DURCjson/orderdetailstatus/{orderdetailstatus_id}', 'orderdetailstatusController@jsonone');
//Route::get('/DURCjson/orderdetailstatus/', 'orderdetailstatusController@jsonall');
//Route::get('/DURCsearchjson/orderdetailstatus/', 'orderdetailstatusController@search');
//
////DURC->	northwind_model.orderStatus
//Route::resource('/DURC/orderstatus', 'orderstatusController');
//Route::get('/DURCjson/orderstatus/{orderstatus_id}', 'orderstatusController@jsonone');
//Route::get('/DURCjson/orderstatus/', 'orderstatusController@jsonall');
//Route::get('/DURCsearchjson/orderstatus/', 'orderstatusController@search');
//
////DURC->	northwind_model.orderTaxStatus
//Route::resource('/DURC/ordertaxstatus', 'ordertaxstatusController');
//Route::get('/DURCjson/ordertaxstatus/{ordertaxstatus_id}', 'ordertaxstatusController@jsonone');
//Route::get('/DURCjson/ordertaxstatus/', 'ordertaxstatusController@jsonall');
//Route::get('/DURCsearchjson/ordertaxstatus/', 'ordertaxstatusController@search');
//
////DURC->	northwind_model.privilege
//Route::resource('/DURC/privilege', 'privilegeController');
//Route::get('/DURCjson/privilege/{privilege_id}', 'privilegeController@jsonone');
//Route::get('/DURCjson/privilege/', 'privilegeController@jsonall');
//Route::get('/DURCsearchjson/privilege/', 'privilegeController@search');
//
////DURC->	northwind_model.product
//Route::resource('/DURC/product', 'productController');
//Route::get('/DURCjson/product/{product_id}', 'productController@jsonone');
//Route::get('/DURCjson/product/', 'productController@jsonall');
//Route::get('/DURCsearchjson/product/', 'productController@search');
//
////DURC->	northwind_model.purchaseOrderStatus
//Route::resource('/DURC/purchaseorderstatus', 'purchaseorderstatusController');
//Route::get('/DURCjson/purchaseorderstatus/{purchaseorderstatus_id}', 'purchaseorderstatusController@jsonone');
//Route::get('/DURCjson/purchaseorderstatus/', 'purchaseorderstatusController@jsonall');
//Route::get('/DURCsearchjson/purchaseorderstatus/', 'purchaseorderstatusController@search');
//
////DURC->	northwind_model.salesReport
//Route::resource('/DURC/salesreport', 'salesreportController');
//Route::get('/DURCjson/salesreport/{salesreport_id}', 'salesreportController@jsonone');
//Route::get('/DURCjson/salesreport/', 'salesreportController@jsonall');
//Route::get('/DURCsearchjson/salesreport/', 'salesreportController@search');
//
////DURC->	northwind_model.shipper
//Route::resource('/DURC/shipper', 'shipperController');
//Route::get('/DURCjson/shipper/{shipper_id}', 'shipperController@jsonone');
//Route::get('/DURCjson/shipper/', 'shipperController@jsonall');
//Route::get('/DURCsearchjson/shipper/', 'shipperController@search');
//
////DURC->	northwind_model.supplier
//Route::resource('/DURC/supplier', 'supplierController');
//Route::get('/DURCjson/supplier/{supplier_id}', 'supplierController@jsonone');
//Route::get('/DURCjson/supplier/', 'supplierController@jsonall');
//Route::get('/DURCsearchjson/supplier/', 'supplierController@search');
//
///*
//	This test route can be added to the web.php route file..
//	IF you would like to quickly see and test all of the index routes that are generated by DURC
//	to use:
//
//	cat routes/durc_test.routes >> routes/web.php
//
//	DURC Generated At: Monday 1st of January 2018 04:58:04 PM
//*/
//
////This closure lists all of the index routes that DURC knows about...
//Route::get('durctest', function () {
//    $route_list = [
//
//
//
//
// 			'/DURC/author', //from: aaaDurctest.author
// 			'/DURC/author/create', //from: aaaDurctest.author
// 			'/DURC/author/1', //from: aaaDurctest.author
// 			'/DURC/author/1/edit', //from: aaaDurctest.author
// 			'/DURC/author_book', //from: aaaDurctest.author_book
// 			'/DURC/author_book/create', //from: aaaDurctest.author_book
// 			'/DURC/author_book/1', //from: aaaDurctest.author_book
// 			'/DURC/author_book/1/edit', //from: aaaDurctest.author_book
// 			'/DURC/authortype', //from: aaaDurctest.authortype
// 			'/DURC/authortype/create', //from: aaaDurctest.authortype
// 			'/DURC/authortype/1', //from: aaaDurctest.authortype
// 			'/DURC/authortype/1/edit', //from: aaaDurctest.authortype
// 			'/DURC/book', //from: aaaDurctest.book
// 			'/DURC/book/create', //from: aaaDurctest.book
// 			'/DURC/book/1', //from: aaaDurctest.book
// 			'/DURC/book/1/edit', //from: aaaDurctest.book
// 			'/DURC/comment', //from: aaaDurctest.comment
// 			'/DURC/comment/create', //from: aaaDurctest.comment
// 			'/DURC/comment/1', //from: aaaDurctest.comment
// 			'/DURC/comment/1/edit', //from: aaaDurctest.comment
// 			'/DURC/donation', //from: aaaDurctest.donation
// 			'/DURC/donation/create', //from: aaaDurctest.donation
// 			'/DURC/donation/1', //from: aaaDurctest.donation
// 			'/DURC/donation/1/edit', //from: aaaDurctest.donation
// 			'/DURC/foreignkeytestgizmo', //from: aaaDurctest.foreignkeytestgizmo
// 			'/DURC/foreignkeytestgizmo/create', //from: aaaDurctest.foreignkeytestgizmo
// 			'/DURC/foreignkeytestgizmo/1', //from: aaaDurctest.foreignkeytestgizmo
// 			'/DURC/foreignkeytestgizmo/1/edit', //from: aaaDurctest.foreignkeytestgizmo
// 			'/DURC/foreignkeytestthingy', //from: aaaDurctest.foreignkeytestthingy
// 			'/DURC/foreignkeytestthingy/create', //from: aaaDurctest.foreignkeytestthingy
// 			'/DURC/foreignkeytestthingy/1', //from: aaaDurctest.foreignkeytestthingy
// 			'/DURC/foreignkeytestthingy/1/edit', //from: aaaDurctest.foreignkeytestthingy
// 			'/DURC/funnything', //from: aaaDurctest.funnything
// 			'/DURC/funnything/create', //from: aaaDurctest.funnything
// 			'/DURC/funnything/1', //from: aaaDurctest.funnything
// 			'/DURC/funnything/1/edit', //from: aaaDurctest.funnything
// 			'/DURC/post', //from: aaaDurctest.post
// 			'/DURC/post/create', //from: aaaDurctest.post
// 			'/DURC/post/1', //from: aaaDurctest.post
// 			'/DURC/post/1/edit', //from: aaaDurctest.post
// 			'/DURC/sibling', //from: aaaDurctest.sibling
// 			'/DURC/sibling/create', //from: aaaDurctest.sibling
// 			'/DURC/sibling/1', //from: aaaDurctest.sibling
// 			'/DURC/sibling/1/edit', //from: aaaDurctest.sibling
// 			'/DURC/vote', //from: aaaDurctest.vote
// 			'/DURC/vote/create', //from: aaaDurctest.vote
// 			'/DURC/vote/1', //from: aaaDurctest.vote
// 			'/DURC/vote/1/edit', //from: aaaDurctest.vote
// 			'/DURC/nonprofitcorp', //from: irs.nonprofitcorp
// 			'/DURC/nonprofitcorp/create', //from: irs.nonprofitcorp
// 			'/DURC/nonprofitcorp/1', //from: irs.nonprofitcorp
// 			'/DURC/nonprofitcorp/1/edit', //from: irs.nonprofitcorp
// 			'/DURC/inventorytransaction', //from: northwind_data.inventoryTransaction
// 			'/DURC/inventorytransaction/create', //from: northwind_data.inventoryTransaction
// 			'/DURC/inventorytransaction/1', //from: northwind_data.inventoryTransaction
// 			'/DURC/inventorytransaction/1/edit', //from: northwind_data.inventoryTransaction
// 			'/DURC/invoice', //from: northwind_data.invoice
// 			'/DURC/invoice/create', //from: northwind_data.invoice
// 			'/DURC/invoice/1', //from: northwind_data.invoice
// 			'/DURC/invoice/1/edit', //from: northwind_data.invoice
// 			'/DURC/order', //from: northwind_data.order
// 			'/DURC/order/create', //from: northwind_data.order
// 			'/DURC/order/1', //from: northwind_data.order
// 			'/DURC/order/1/edit', //from: northwind_data.order
// 			'/DURC/orderdetail', //from: northwind_data.orderDetail
// 			'/DURC/orderdetail/create', //from: northwind_data.orderDetail
// 			'/DURC/orderdetail/1', //from: northwind_data.orderDetail
// 			'/DURC/orderdetail/1/edit', //from: northwind_data.orderDetail
// 			'/DURC/purchaseorder', //from: northwind_data.purchaseOrder
// 			'/DURC/purchaseorder/create', //from: northwind_data.purchaseOrder
// 			'/DURC/purchaseorder/1', //from: northwind_data.purchaseOrder
// 			'/DURC/purchaseorder/1/edit', //from: northwind_data.purchaseOrder
// 			'/DURC/purchaseorderdetail', //from: northwind_data.purchaseOrderDetail
// 			'/DURC/purchaseorderdetail/create', //from: northwind_data.purchaseOrderDetail
// 			'/DURC/purchaseorderdetail/1', //from: northwind_data.purchaseOrderDetail
// 			'/DURC/purchaseorderdetail/1/edit', //from: northwind_data.purchaseOrderDetail
// 			'/DURC/appstring', //from: northwind_model.appstring
// 			'/DURC/appstring/create', //from: northwind_model.appstring
// 			'/DURC/appstring/1', //from: northwind_model.appstring
// 			'/DURC/appstring/1/edit', //from: northwind_model.appstring
// 			'/DURC/customer', //from: northwind_model.customer
// 			'/DURC/customer/create', //from: northwind_model.customer
// 			'/DURC/customer/1', //from: northwind_model.customer
// 			'/DURC/customer/1/edit', //from: northwind_model.customer
// 			'/DURC/employee', //from: northwind_model.employee
// 			'/DURC/employee/create', //from: northwind_model.employee
// 			'/DURC/employee/1', //from: northwind_model.employee
// 			'/DURC/employee/1/edit', //from: northwind_model.employee
// 			'/DURC/employeeprivilege', //from: northwind_model.employeePrivilege
// 			'/DURC/employeeprivilege/create', //from: northwind_model.employeePrivilege
// 			'/DURC/employeeprivilege/1', //from: northwind_model.employeePrivilege
// 			'/DURC/employeeprivilege/1/edit', //from: northwind_model.employeePrivilege
// 			'/DURC/inventorytransactiontype', //from: northwind_model.inventoryTransactionType
// 			'/DURC/inventorytransactiontype/create', //from: northwind_model.inventoryTransactionType
// 			'/DURC/inventorytransactiontype/1', //from: northwind_model.inventoryTransactionType
// 			'/DURC/inventorytransactiontype/1/edit', //from: northwind_model.inventoryTransactionType
// 			'/DURC/orderdetailstatus', //from: northwind_model.orderDetailStatus
// 			'/DURC/orderdetailstatus/create', //from: northwind_model.orderDetailStatus
// 			'/DURC/orderdetailstatus/1', //from: northwind_model.orderDetailStatus
// 			'/DURC/orderdetailstatus/1/edit', //from: northwind_model.orderDetailStatus
// 			'/DURC/orderstatus', //from: northwind_model.orderStatus
// 			'/DURC/orderstatus/create', //from: northwind_model.orderStatus
// 			'/DURC/orderstatus/1', //from: northwind_model.orderStatus
// 			'/DURC/orderstatus/1/edit', //from: northwind_model.orderStatus
// 			'/DURC/ordertaxstatus', //from: northwind_model.orderTaxStatus
// 			'/DURC/ordertaxstatus/create', //from: northwind_model.orderTaxStatus
// 			'/DURC/ordertaxstatus/1', //from: northwind_model.orderTaxStatus
// 			'/DURC/ordertaxstatus/1/edit', //from: northwind_model.orderTaxStatus
// 			'/DURC/privilege', //from: northwind_model.privilege
// 			'/DURC/privilege/create', //from: northwind_model.privilege
// 			'/DURC/privilege/1', //from: northwind_model.privilege
// 			'/DURC/privilege/1/edit', //from: northwind_model.privilege
// 			'/DURC/product', //from: northwind_model.product
// 			'/DURC/product/create', //from: northwind_model.product
// 			'/DURC/product/1', //from: northwind_model.product
// 			'/DURC/product/1/edit', //from: northwind_model.product
// 			'/DURC/purchaseorderstatus', //from: northwind_model.purchaseOrderStatus
// 			'/DURC/purchaseorderstatus/create', //from: northwind_model.purchaseOrderStatus
// 			'/DURC/purchaseorderstatus/1', //from: northwind_model.purchaseOrderStatus
// 			'/DURC/purchaseorderstatus/1/edit', //from: northwind_model.purchaseOrderStatus
// 			'/DURC/salesreport', //from: northwind_model.salesReport
// 			'/DURC/salesreport/create', //from: northwind_model.salesReport
// 			'/DURC/salesreport/1', //from: northwind_model.salesReport
// 			'/DURC/salesreport/1/edit', //from: northwind_model.salesReport
// 			'/DURC/shipper', //from: northwind_model.shipper
// 			'/DURC/shipper/create', //from: northwind_model.shipper
// 			'/DURC/shipper/1', //from: northwind_model.shipper
// 			'/DURC/shipper/1/edit', //from: northwind_model.shipper
// 			'/DURC/supplier', //from: northwind_model.supplier
// 			'/DURC/supplier/create', //from: northwind_model.supplier
// 			'/DURC/supplier/1', //from: northwind_model.supplier
// 			'/DURC/supplier/1/edit', //from: northwind_model.supplier
//
//
//	]; //end route_list
//
//	$html = '<html><head><title>DURC Test Page</title><body><h1>DURC Test Page</h1><h3>DO NOT USE IN PRODUCTION!!!</h3>';
//
//	$html .= '<ul>';
//
//	foreach($route_list as $this_relative_link){
//		$html  .= "<li><a href='$this_relative_link'>$this_relative_link </a> </li> ";
//	}
//
//	$html .= '</ul></body></html>';
//	return $html;
//}); //end DURC test route closure
//
//Route::get('/',function () {
//	$test_data = ['content' => '<h1>This is test content</h1>'];
//	return view('DURC.durc_html',$test_data);
//});
