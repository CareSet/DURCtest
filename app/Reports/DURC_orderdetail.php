<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=16b76b5a78c9ea7502b3e6ba34fda7c6
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_orderdetail extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "orderdetail Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the orderdetail data
			<br>
			<a href='/DURC/orderdetail/create'>Add new orderdetail</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\orderdetail::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$order_field = \App\order::getNameField();	
	$joined_select_field_sql .= "
, A_order.$order_field  AS $order_field
"; 
	$order_img_field = \App\order::getImgField();
	if(!is_null($order_img_field)){
		if($is_debug){echo "order has an image field of: |$order_img_field|
";}
		$joined_select_field_sql .= "
, A_order.$order_img_field  AS $order_img_field
"; 
	}

	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, B_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, B_product.$product_img_field  AS $product_img_field
"; 
	}

	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, C_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, C_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
orderDetail.id
$joined_select_field_sql 
, orderDetail.order_id AS order_id
, orderDetail.product_id AS product_id
, orderDetail.quantity AS quantity
, orderDetail.unitPrice AS unitPrice
, orderDetail.discount AS discount
, orderDetail.status_id AS status_id
, orderDetail.dateAllocated AS dateAllocated
, orderDetail.PurchaseOrder_id AS PurchaseOrder_id
, orderDetail.inventory_id AS inventory_id

FROM northwind_data.orderDetail

LEFT JOIN northwind_data.order AS A_order ON 
	A_order.id =
	orderDetail.order_id

LEFT JOIN northwind_model.product AS B_product ON 
	B_product.id =
	orderDetail.product_id

LEFT JOIN northwind_data.purchaseOrder AS C_purchaseOrder ON 
	C_purchaseOrder.id =
	orderDetail.PurchaseOrder_id

";

        }else{

                $sql = "
SELECT
orderDetail.id 
$joined_select_field_sql
, orderDetail.order_id AS order_id
, orderDetail.product_id AS product_id
, orderDetail.quantity AS quantity
, orderDetail.unitPrice AS unitPrice
, orderDetail.discount AS discount
, orderDetail.status_id AS status_id
, orderDetail.dateAllocated AS dateAllocated
, orderDetail.PurchaseOrder_id AS PurchaseOrder_id
, orderDetail.inventory_id AS inventory_id
 
FROM northwind_data.orderDetail 

LEFT JOIN northwind_data.order AS A_order ON 
	A_order.id =
	orderDetail.order_id

LEFT JOIN northwind_model.product AS B_product ON 
	B_product.id =
	orderDetail.product_id

LEFT JOIN northwind_data.purchaseOrder AS C_purchaseOrder ON 
	C_purchaseOrder.id =
	orderDetail.PurchaseOrder_id

WHERE orderDetail.id = $index
";

        }

        if($is_debug){
                echo "<pre>$sql";
                exit();
        }

        return $sql;
    }

    //decorate the results of the query with useful results
    public function MapRow(array $row, int $row_number) :array
    {

	$is_debug = false;
	
	//we think it is safe to extract here because we are getting this from the DB and not a user directly..
        extract($row);


	//get the local image field for this report... null if not found..
	$img_field_name = \App\orderdetail::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$order_field = \App\order::getNameField();	
	$joined_select_field_sql .= "
, A_order.$order_field  AS $order_field
"; 
	$order_img_field = \App\order::getImgField();
	if(!is_null($order_img_field)){
		if($is_debug){echo "order has an image field of: |$order_img_field|
";}
		$joined_select_field_sql .= "
, A_order.$order_img_field  AS $order_img_field
"; 
	}

	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, B_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, B_product.$product_img_field  AS $product_img_field
"; 
	}

	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, C_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, C_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/orderdetail/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$order_tmp = ''.$order_field;
if(isset($row[$order_tmp])){
	$order_data = $row[$order_tmp];
	$row[$order_tmp] = "<a target='_blank' href='/Zermelo/DURC_order/$order_id'>$order_data</a>";
}

$order_img_tmp = ''.$order_img_field;
if(isset($row[$order_img_tmp]) && strlen($order_img_tmp) > 0){
	$order_img_data = $row[$order_img_tmp];
	$row[$order_img_tmp] = "<img width='200px' src='$order_img_data'>";
}

$product_tmp = ''.$product_field;
if(isset($row[$product_tmp])){
	$product_data = $row[$product_tmp];
	$row[$product_tmp] = "<a target='_blank' href='/Zermelo/DURC_product/$product_id'>$product_data</a>";
}

$product_img_tmp = ''.$product_img_field;
if(isset($row[$product_img_tmp]) && strlen($product_img_tmp) > 0){
	$product_img_data = $row[$product_img_tmp];
	$row[$product_img_tmp] = "<img width='200px' src='$product_img_data'>";
}

$purchaseorder_tmp = ''.$purchaseOrder_field;
if(isset($row[$purchaseorder_tmp])){
	$purchaseorder_data = $row[$purchaseorder_tmp];
	$row[$purchaseorder_tmp] = "<a target='_blank' href='/Zermelo/DURC_purchaseOrder/$PurchaseOrder_id'>$purchaseorder_data</a>";
}

$purchaseorder_img_tmp = ''.$purchaseOrder_img_field;
if(isset($row[$purchaseorder_img_tmp]) && strlen($purchaseorder_img_tmp) > 0){
	$purchaseorder_img_data = $row[$purchaseorder_img_tmp];
	$row[$purchaseorder_img_tmp] = "<img width='200px' src='$purchaseorder_img_data'>";
}



        return $row;
    }

    //see Zermelo documentation to understand following functions:
    //https://github.com/CareSet/Zermelo

    public $NUMBER     = ['ROWS','AVG','LENGTH','DATA_FREE'];
    public $CURRENCY = [];
    public $SUGGEST_NO_SUMMARY = ['ID'];
    public $REPORT_VIEW = null;

    public function OverrideHeader(array &$format, array &$tags): void
    {
    }

    public function GetIndexSQL(): ?array {
                return(null);
    }

        //turns on the cache, should be off for development and small databases or simple queries
   public function isCacheEnabled(){
        return(false);
   }

        //only matters if the cache is on
   public function howLongToCacheInSeconds(){
        return(1200); //twenty minutes by default
   }

}

/*

//fields:
array (
  0 => 
  array (
    'column_name' => 'id',
    'data_type' => 'int',
    'is_primary_key' => true,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  1 => 
  array (
    'column_name' => 'order_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'order',
  ),
  2 => 
  array (
    'column_name' => 'product_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_model',
    'foreign_table' => 'product',
  ),
  3 => 
  array (
    'column_name' => 'quantity',
    'data_type' => 'decimal',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  4 => 
  array (
    'column_name' => 'unitPrice',
    'data_type' => 'decimal',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  5 => 
  array (
    'column_name' => 'discount',
    'data_type' => 'double',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  6 => 
  array (
    'column_name' => 'status_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_model',
    'foreign_table' => 'orderDetailStatus',
  ),
  7 => 
  array (
    'column_name' => 'dateAllocated',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  8 => 
  array (
    'column_name' => 'PurchaseOrder_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'purchaseOrder',
  ),
  9 => 
  array (
    'column_name' => 'inventory_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'order' => 
  array (
    'prefix' => NULL,
    'type' => 'order',
    'to_table' => 'order',
    'to_db' => 'northwind_data',
    'local_key' => 'order_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      1 => 
      array (
        'column_name' => 'employee_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'employee',
      ),
      2 => 
      array (
        'column_name' => 'customer_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'customer',
      ),
      3 => 
      array (
        'column_name' => 'orderDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'shippedDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'shipper_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'shipper',
      ),
      6 => 
      array (
        'column_name' => 'shipName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      7 => 
      array (
        'column_name' => 'shipAddress',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      8 => 
      array (
        'column_name' => 'shipCity',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      9 => 
      array (
        'column_name' => 'shipStateProvince',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      10 => 
      array (
        'column_name' => 'shipZipPostalCode',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      11 => 
      array (
        'column_name' => 'shipCountryRegion',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      12 => 
      array (
        'column_name' => 'shippingFee',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      13 => 
      array (
        'column_name' => 'taxes',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      14 => 
      array (
        'column_name' => 'paymentType',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      15 => 
      array (
        'column_name' => 'paidDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      16 => 
      array (
        'column_name' => 'notes',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      17 => 
      array (
        'column_name' => 'taxRate',
        'data_type' => 'double',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      18 => 
      array (
        'column_name' => 'taxStatus_id',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'orderTaxStatus',
      ),
      19 => 
      array (
        'column_name' => 'status_id',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'orderStatus',
      ),
    ),
  ),
  'product' => 
  array (
    'prefix' => NULL,
    'type' => 'product',
    'to_table' => 'product',
    'to_db' => 'northwind_model',
    'local_key' => 'product_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'supplier_ids',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      1 => 
      array (
        'column_name' => 'id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'productCode',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'productName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'description',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'standardCost',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      6 => 
      array (
        'column_name' => 'listPrice',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      7 => 
      array (
        'column_name' => 'reorderLevel',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      8 => 
      array (
        'column_name' => 'targetLevel',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      9 => 
      array (
        'column_name' => 'quantityPerUnit',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      10 => 
      array (
        'column_name' => 'discontinued',
        'data_type' => 'tinyint',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      11 => 
      array (
        'column_name' => 'minimumReorderQuantity',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      12 => 
      array (
        'column_name' => 'category',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      13 => 
      array (
        'column_name' => 'attachments',
        'data_type' => 'longblob',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
  'purchaseorder' => 
  array (
    'prefix' => NULL,
    'type' => 'purchaseorder',
    'to_table' => 'purchaseOrder',
    'to_db' => 'northwind_data',
    'local_key' => 'PurchaseOrder_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      1 => 
      array (
        'column_name' => 'supplier_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'supplier',
      ),
      2 => 
      array (
        'column_name' => 'createdBy_employee_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'employee',
      ),
      3 => 
      array (
        'column_name' => 'submittedDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'creationDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'status_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'purchaseOrderStatus',
      ),
      6 => 
      array (
        'column_name' => 'expectedDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      7 => 
      array (
        'column_name' => 'shippingFee',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      8 => 
      array (
        'column_name' => 'taxes',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      9 => 
      array (
        'column_name' => 'paymentDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      10 => 
      array (
        'column_name' => 'paymentAmount',
        'data_type' => 'decimal',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      11 => 
      array (
        'column_name' => 'paymentMethod',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      12 => 
      array (
        'column_name' => 'notes',
        'data_type' => 'longtext',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      13 => 
      array (
        'column_name' => 'approvedBy_employee_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'employee',
      ),
      14 => 
      array (
        'column_name' => 'approvedDate',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      15 => 
      array (
        'column_name' => 'submittedBy_employee_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'employee',
      ),
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>