<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=7a5c550296c9d707e6e279627aa7d25c
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_inventorytransaction extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "inventorytransaction Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the inventorytransaction data
			<br>
			<a href='/DURC/inventorytransaction/create'>Add new inventorytransaction</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\inventorytransaction::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, A_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, A_product.$product_img_field  AS $product_img_field
"; 
	}

	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, B_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, B_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
inventoryTransaction.id
$joined_select_field_sql 
, inventoryTransaction.transactionType AS transactionType
, inventoryTransaction.transactionCreatedDate AS transactionCreatedDate
, inventoryTransaction.transactionModifiedDate AS transactionModifiedDate
, inventoryTransaction.product_id AS product_id
, inventoryTransaction.quantity AS quantity
, inventoryTransaction.purchaseOrder_id AS purchaseOrder_id
, inventoryTransaction.customerOrder_id AS customerOrder_id
, inventoryTransaction.comments AS comments

FROM northwind_data.inventoryTransaction

LEFT JOIN northwind_model.product AS A_product ON 
	A_product.id =
	inventoryTransaction.product_id

LEFT JOIN northwind_data.purchaseOrder AS B_purchaseOrder ON 
	B_purchaseOrder.id =
	inventoryTransaction.purchaseOrder_id

";

        }else{

                $sql = "
SELECT
inventoryTransaction.id 
$joined_select_field_sql
, inventoryTransaction.transactionType AS transactionType
, inventoryTransaction.transactionCreatedDate AS transactionCreatedDate
, inventoryTransaction.transactionModifiedDate AS transactionModifiedDate
, inventoryTransaction.product_id AS product_id
, inventoryTransaction.quantity AS quantity
, inventoryTransaction.purchaseOrder_id AS purchaseOrder_id
, inventoryTransaction.customerOrder_id AS customerOrder_id
, inventoryTransaction.comments AS comments
 
FROM northwind_data.inventoryTransaction 

LEFT JOIN northwind_model.product AS A_product ON 
	A_product.id =
	inventoryTransaction.product_id

LEFT JOIN northwind_data.purchaseOrder AS B_purchaseOrder ON 
	B_purchaseOrder.id =
	inventoryTransaction.purchaseOrder_id

WHERE inventoryTransaction.id = $index
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
	$img_field_name = \App\inventorytransaction::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$product_field = \App\product::getNameField();	
	$joined_select_field_sql .= "
, A_product.$product_field  AS $product_field
"; 
	$product_img_field = \App\product::getImgField();
	if(!is_null($product_img_field)){
		if($is_debug){echo "product has an image field of: |$product_img_field|
";}
		$joined_select_field_sql .= "
, A_product.$product_img_field  AS $product_img_field
"; 
	}

	$purchaseOrder_field = \App\purchaseorder::getNameField();	
	$joined_select_field_sql .= "
, B_purchaseOrder.$purchaseOrder_field  AS $purchaseOrder_field
"; 
	$purchaseOrder_img_field = \App\purchaseorder::getImgField();
	if(!is_null($purchaseOrder_img_field)){
		if($is_debug){echo "purchaseOrder has an image field of: |$purchaseOrder_img_field|
";}
		$joined_select_field_sql .= "
, B_purchaseOrder.$purchaseOrder_img_field  AS $purchaseOrder_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/inventorytransaction/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
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
	$row[$purchaseorder_tmp] = "<a target='_blank' href='/Zermelo/DURC_purchaseOrder/$purchaseOrder_id'>$purchaseorder_data</a>";
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
    'column_name' => 'transactionType',
    'data_type' => 'tinyint',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_model',
    'foreign_table' => 'inventorytransactiontype',
  ),
  2 => 
  array (
    'column_name' => 'transactionCreatedDate',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  3 => 
  array (
    'column_name' => 'transactionModifiedDate',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  4 => 
  array (
    'column_name' => 'product_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_model',
    'foreign_table' => 'product',
  ),
  5 => 
  array (
    'column_name' => 'quantity',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  6 => 
  array (
    'column_name' => 'purchaseOrder_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'purchaseOrder',
  ),
  7 => 
  array (
    'column_name' => 'customerOrder_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_data',
    'foreign_table' => 'order',
  ),
  8 => 
  array (
    'column_name' => 'comments',
    'data_type' => 'varchar',
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
)
//many_many
NULL
//many_through
NULL*/


?>