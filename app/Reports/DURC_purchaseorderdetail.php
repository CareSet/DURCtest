<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=7719398bc6c2ec80d813eea34180b903
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_purchaseorderdetail extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "purchaseorderdetail Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the purchaseorderdetail data
			<br>
			<a href='/DURC/purchaseorderdetail/create'>Add new purchaseorderdetail</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\purchaseorderdetail::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, A_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, A_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
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


        if(is_null($index)){

                $sql = "
SELECT
purchaseOrderDetail.id
$joined_select_field_sql 
, purchaseOrderDetail.purchaseOrder_id AS purchaseOrder_id
, purchaseOrderDetail.product_id AS product_id
, purchaseOrderDetail.quantity AS quantity
, purchaseOrderDetail.unitCost AS unitCost
, purchaseOrderDetail.dateReceived AS dateReceived
, purchaseOrderDetail.postedToInventory AS postedToInventory
, purchaseOrderDetail.inventory_id AS inventory_id

FROM northwind_data.purchaseOrderDetail

LEFT JOIN northwind_data.purchaseOrder AS A_purchaseOrder ON 
	A_purchaseOrder.id =
	purchaseOrderDetail.purchaseOrder_id

LEFT JOIN northwind_model.product AS B_product ON 
	B_product.id =
	purchaseOrderDetail.product_id

";

        }else{

                $sql = "
SELECT
purchaseOrderDetail.id 
$joined_select_field_sql
, purchaseOrderDetail.purchaseOrder_id AS purchaseOrder_id
, purchaseOrderDetail.product_id AS product_id
, purchaseOrderDetail.quantity AS quantity
, purchaseOrderDetail.unitCost AS unitCost
, purchaseOrderDetail.dateReceived AS dateReceived
, purchaseOrderDetail.postedToInventory AS postedToInventory
, purchaseOrderDetail.inventory_id AS inventory_id
 
FROM northwind_data.purchaseOrderDetail 

LEFT JOIN northwind_data.purchaseOrder AS A_purchaseOrder ON 
	A_purchaseOrder.id =
	purchaseOrderDetail.purchaseOrder_id

LEFT JOIN northwind_model.product AS B_product ON 
	B_product.id =
	purchaseOrderDetail.product_id

WHERE purchaseOrderDetail.id = $index
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
	$img_field_name = \App\purchaseorderdetail::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, A_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, A_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
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



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/purchaseorderdetail/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$purchaseorder_tmp = ''.$purchaseOrder_field;
if(isset($row[$purchaseorder_tmp])){
	$purchaseorder_data = $row[$purchaseorder_tmp];
	$row[$purchaseorder_tmp] = "<a target='_blank' href='/Zermelo/DURC_purchaseOrder/$purchaseOrder_id'>$purchaseorder_data</a>";
}

$purchaseorder_img_tmp = ''.$purchaseOrder_img_field;
if(isset($row[$purchaseorder_img_tmp]) && strlen($purchaseorder_img_tmp) > 0){
	$purchaseorder_img_data = $row[$purchaseorder_img_tmp];
	$row[$purchaseorder_img_tmp] = "<img width='200px' src='$purchaseorder_img_data'>";
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
    'column_name' => 'purchaseOrder_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'purchaseOrder',
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
    'column_name' => 'unitCost',
    'data_type' => 'decimal',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  5 => 
  array (
    'column_name' => 'dateReceived',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  6 => 
  array (
    'column_name' => 'postedToInventory',
    'data_type' => 'tinyint',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  7 => 
  array (
    'column_name' => 'inventory_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'inventorytransaction',
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'purchaseorder' => 
  array (
    'prefix' => NULL,
    'type' => 'purchaseorder',
    'to_table' => 'purchaseOrder',
    'to_db' => 'northwind_data',
    'local_key' => 'purchaseOrder_id',
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
)
//many_many
NULL
//many_through
NULL*/


?>