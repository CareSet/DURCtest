<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=f64da5d7117ba8849d29355d6a751766
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_product extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "product Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the product data
			<br>
			<a href='/DURC/product/create'>Add new product</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\product::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
product.id
$joined_select_field_sql 
, product.supplier_ids AS supplier_ids
, product.productCode AS productCode
, product.productName AS productName
, product.description AS description
, product.standardCost AS standardCost
, product.listPrice AS listPrice
, product.reorderLevel AS reorderLevel
, product.targetLevel AS targetLevel
, product.quantityPerUnit AS quantityPerUnit
, product.discontinued AS discontinued
, product.minimumReorderQuantity AS minimumReorderQuantity
, product.category AS category
, product.attachments AS attachments

FROM northwind_model.product

";

        }else{

                $sql = "
SELECT
product.id 
$joined_select_field_sql
, product.supplier_ids AS supplier_ids
, product.productCode AS productCode
, product.productName AS productName
, product.description AS description
, product.standardCost AS standardCost
, product.listPrice AS listPrice
, product.reorderLevel AS reorderLevel
, product.targetLevel AS targetLevel
, product.quantityPerUnit AS quantityPerUnit
, product.discontinued AS discontinued
, product.minimumReorderQuantity AS minimumReorderQuantity
, product.category AS category
, product.attachments AS attachments
 
FROM northwind_model.product 

WHERE product.id = $index
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
	$img_field_name = \App\product::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/product/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
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
    'column_name' => 'supplier_ids',
    'data_type' => 'longtext',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => true,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => '0.0000',
    'is_auto_increment' => false,
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
    'is_nullable' => false,
    'default_value' => '0.0000',
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => false,
    'default_value' => '0',
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
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
    'is_nullable' => true,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*/


?>