<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=afae18900311c576fea1d332772f08e6
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_privilege extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "privilege Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the privilege data
			<br>
			<a href='/DURC/privilege/create'>Add new privilege</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\privilege::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
privilege.id
$joined_select_field_sql 
, privilege.privilegeName AS privilegeName

FROM northwind_model.privilege

";

        }else{

                $sql = "
SELECT
privilege.id 
$joined_select_field_sql
, privilege.privilegeName AS privilegeName
 
FROM northwind_model.privilege 

WHERE privilege.id = $index
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
	$img_field_name = \App\privilege::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/privilege/$id'>$id</a>";



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
    'from_column' => 'privilege_id',
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