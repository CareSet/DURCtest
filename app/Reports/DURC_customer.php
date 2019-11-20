<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=c878a39fbd2bf1beeea7a6ac162de3d1
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_customer extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "customer Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the customer data
			<br>
			<a href='/DURC/customer/create'>Add new customer</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\customer::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
customer.id
$joined_select_field_sql 
, customer.companyName AS companyName
, customer.lastName AS lastName
, customer.firstName AS firstName
, customer.emailAddress AS emailAddress
, customer.jobTitle AS jobTitle
, customer.businessPhone AS businessPhone
, customer.homePhone AS homePhone
, customer.mobilePhone AS mobilePhone
, customer.faxNumber AS faxNumber
, customer.address AS address
, customer.city AS city
, customer.stateProvince AS stateProvince
, customer.zipPostalCode AS zipPostalCode
, customer.countryRegion AS countryRegion
, customer.webPage AS webPage
, customer.notes AS notes
, customer.attachments AS attachments
, customer.random_date AS random_date
, customer.created_at AS created_at
, customer.updated_at AS updated_at
, customer.deleted_at AS deleted_at

FROM northwind_model.customer

";

        }else{

                $sql = "
SELECT
customer.id 
$joined_select_field_sql
, customer.companyName AS companyName
, customer.lastName AS lastName
, customer.firstName AS firstName
, customer.emailAddress AS emailAddress
, customer.jobTitle AS jobTitle
, customer.businessPhone AS businessPhone
, customer.homePhone AS homePhone
, customer.mobilePhone AS mobilePhone
, customer.faxNumber AS faxNumber
, customer.address AS address
, customer.city AS city
, customer.stateProvince AS stateProvince
, customer.zipPostalCode AS zipPostalCode
, customer.countryRegion AS countryRegion
, customer.webPage AS webPage
, customer.notes AS notes
, customer.attachments AS attachments
, customer.random_date AS random_date
, customer.created_at AS created_at
, customer.updated_at AS updated_at
, customer.deleted_at AS deleted_at
 
FROM northwind_model.customer 

WHERE customer.id = $index
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
	$img_field_name = \App\customer::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/customer/$id'>$id</a>";



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
  1 => 
  array (
    'column_name' => 'companyName',
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
  2 => 
  array (
    'column_name' => 'lastName',
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
    'column_name' => 'firstName',
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
    'column_name' => 'emailAddress',
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
  5 => 
  array (
    'column_name' => 'jobTitle',
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
  6 => 
  array (
    'column_name' => 'businessPhone',
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
  7 => 
  array (
    'column_name' => 'homePhone',
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
  8 => 
  array (
    'column_name' => 'mobilePhone',
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
  9 => 
  array (
    'column_name' => 'faxNumber',
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
    'column_name' => 'address',
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
  11 => 
  array (
    'column_name' => 'city',
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
  12 => 
  array (
    'column_name' => 'stateProvince',
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
    'column_name' => 'zipPostalCode',
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
  14 => 
  array (
    'column_name' => 'countryRegion',
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
  15 => 
  array (
    'column_name' => 'webPage',
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
  16 => 
  array (
    'column_name' => 'notes',
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
  17 => 
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
  18 => 
  array (
    'column_name' => 'random_date',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  19 => 
  array (
    'column_name' => 'created_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  20 => 
  array (
    'column_name' => 'updated_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
    'default_value' => NULL,
    'is_auto_increment' => false,
  ),
  21 => 
  array (
    'column_name' => 'deleted_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
    'is_nullable' => false,
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