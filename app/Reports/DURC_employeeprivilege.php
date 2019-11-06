<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=c06f55f1ec4a08fda5054ab8faa8d84a
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_employeeprivilege extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "employeeprivilege Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the employeeprivilege data
			<br>
			<a href='/DURC/employeeprivilege/create'>Add new employeeprivilege</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\employeeprivilege::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$employee_field = \App\employee::getNameField();	
	$joined_select_field_sql .= "
, A_employee.$employee_field  AS $employee_field
"; 
	$employee_img_field = \App\employee::getImgField();
	if(!is_null($employee_img_field)){
		if($is_debug){echo "employee has an image field of: |$employee_img_field|
";}
		$joined_select_field_sql .= "
, A_employee.$employee_img_field  AS $employee_img_field
"; 
	}

	$privilege_field = \App\privilege::getNameField();	
	$joined_select_field_sql .= "
, B_privilege.$privilege_field  AS $privilege_field
"; 
	$privilege_img_field = \App\privilege::getImgField();
	if(!is_null($privilege_img_field)){
		if($is_debug){echo "privilege has an image field of: |$privilege_img_field|
";}
		$joined_select_field_sql .= "
, B_privilege.$privilege_img_field  AS $privilege_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
employeePrivilege.id
$joined_select_field_sql 
, employeePrivilege.employee_id AS employee_id
, employeePrivilege.privilege_id AS privilege_id

FROM northwind_model.employeePrivilege

LEFT JOIN northwind_model.employee AS A_employee ON 
	A_employee.id =
	employeePrivilege.employee_id

LEFT JOIN northwind_model.privilege AS B_privilege ON 
	B_privilege.id =
	employeePrivilege.privilege_id

";

        }else{

                $sql = "
SELECT
employeePrivilege.id 
$joined_select_field_sql
, employeePrivilege.employee_id AS employee_id
, employeePrivilege.privilege_id AS privilege_id
 
FROM northwind_model.employeePrivilege 

LEFT JOIN northwind_model.employee AS A_employee ON 
	A_employee.id =
	employeePrivilege.employee_id

LEFT JOIN northwind_model.privilege AS B_privilege ON 
	B_privilege.id =
	employeePrivilege.privilege_id

WHERE employeePrivilege.id = $index
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
	$img_field_name = \App\employeeprivilege::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$employee_field = \App\employee::getNameField();	
	$joined_select_field_sql .= "
, A_employee.$employee_field  AS $employee_field
"; 
	$employee_img_field = \App\employee::getImgField();
	if(!is_null($employee_img_field)){
		if($is_debug){echo "employee has an image field of: |$employee_img_field|
";}
		$joined_select_field_sql .= "
, A_employee.$employee_img_field  AS $employee_img_field
"; 
	}

	$privilege_field = \App\privilege::getNameField();	
	$joined_select_field_sql .= "
, B_privilege.$privilege_field  AS $privilege_field
"; 
	$privilege_img_field = \App\privilege::getImgField();
	if(!is_null($privilege_img_field)){
		if($is_debug){echo "privilege has an image field of: |$privilege_img_field|
";}
		$joined_select_field_sql .= "
, B_privilege.$privilege_img_field  AS $privilege_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/employeeprivilege/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$employee_tmp = ''.$employee_field;
if(isset($row[$employee_tmp])){
	$employee_data = $row[$employee_tmp];
	$row[$employee_tmp] = "<a target='_blank' href='/Zermelo/DURC_employee/$employee_id'>$employee_data</a>";
}

$employee_img_tmp = ''.$employee_img_field;
if(isset($row[$employee_img_tmp]) && strlen($employee_img_tmp) > 0){
	$employee_img_data = $row[$employee_img_tmp];
	$row[$employee_img_tmp] = "<img width='200px' src='$employee_img_data'>";
}

$privilege_tmp = ''.$privilege_field;
if(isset($row[$privilege_tmp])){
	$privilege_data = $row[$privilege_tmp];
	$row[$privilege_tmp] = "<a target='_blank' href='/Zermelo/DURC_privilege/$privilege_id'>$privilege_data</a>";
}

$privilege_img_tmp = ''.$privilege_img_field;
if(isset($row[$privilege_img_tmp]) && strlen($privilege_img_tmp) > 0){
	$privilege_img_data = $row[$privilege_img_tmp];
	$row[$privilege_img_tmp] = "<img width='200px' src='$privilege_img_data'>";
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
    'column_name' => 'employee_id',
    'data_type' => 'int',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'northwind_model',
    'foreign_table' => 'employee',
    'is_nullable' => false,
    'default_value' => NULL,
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
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'employee' => 
  array (
    'prefix' => NULL,
    'type' => 'employee',
    'to_table' => 'employee',
    'to_db' => 'northwind_model',
    'local_key' => 'employee_id',
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
        'is_nullable' => false,
        'default_value' => NULL,
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
      ),
    ),
  ),
  'privilege' => 
  array (
    'prefix' => NULL,
    'type' => 'privilege',
    'to_table' => 'privilege',
    'to_db' => 'northwind_model',
    'local_key' => 'privilege_id',
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
        'is_nullable' => false,
        'default_value' => NULL,
      ),
      1 => 
      array (
        'column_name' => 'privilegeName',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
        'is_nullable' => true,
        'default_value' => NULL,
      ),
    ),
  ),
)
//many_many
NULL
//many_through
NULL*/


?>