<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=e61d74cad0d4d3643eb7c8e2a29c48dd
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_employee extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "employee Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the employee data
			<br>
			<a href='/DURC/employee/create'>Add new employee</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\employee::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
employee.id
$joined_select_field_sql 
, employee.company AS company
, employee.lastName AS lastName
, employee.firstName AS firstName
, employee.emailAddress AS emailAddress
, employee.jobTitle AS jobTitle
, employee.businessPhone AS businessPhone
, employee.homePhone AS homePhone
, employee.mobilePhone AS mobilePhone
, employee.faxNumber AS faxNumber
, employee.address AS address
, employee.city AS city
, employee.stateProvince AS stateProvince
, employee.zipPostalCode AS zipPostalCode
, employee.countryRegion AS countryRegion
, employee.webPage AS webPage
, employee.notes AS notes
, employee.attachments AS attachments

FROM northwind_model.employee

";

        }else{

                $sql = "
SELECT
employee.id 
$joined_select_field_sql
, employee.company AS company
, employee.lastName AS lastName
, employee.firstName AS firstName
, employee.emailAddress AS emailAddress
, employee.jobTitle AS jobTitle
, employee.businessPhone AS businessPhone
, employee.homePhone AS homePhone
, employee.mobilePhone AS mobilePhone
, employee.faxNumber AS faxNumber
, employee.address AS address
, employee.city AS city
, employee.stateProvince AS stateProvince
, employee.zipPostalCode AS zipPostalCode
, employee.countryRegion AS countryRegion
, employee.webPage AS webPage
, employee.notes AS notes
, employee.attachments AS attachments
 
FROM northwind_model.employee 

WHERE employee.id = $index
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
	$img_field_name = \App\employee::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/employee/$id'>$id</a>";



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
    'column_name' => 'company',
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
)
//has_many
NULL
//has_one
array (
  'employeeprivilege' => 
  array (
    'prefix' => NULL,
    'type' => 'employeeprivilege',
    'from_table' => 'employeePrivilege',
    'from_db' => 'northwind_model',
    'from_column' => 'employee_id',
    'other_columns' => 
    array (
      0 => 
      array (
        'column_name' => 'employee_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'employee',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
      1 => 
      array (
        'column_name' => 'privilege_id',
        'data_type' => 'int',
        'is_primary_key' => true,
        'is_foreign_key' => true,
        'is_linked_key' => true,
        'foreign_db' => 'northwind_model',
        'foreign_table' => 'privilege',
        'is_nullable' => false,
        'default_value' => NULL,
        'is_auto_increment' => false,
      ),
    ),
  ),
)
//belongs_to
NULL
//many_many
NULL
//many_through
NULL*/


?>