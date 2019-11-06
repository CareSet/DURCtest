<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=78f20d9fcf3e7fb74c404060fc03a94a
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_sibling extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "sibling Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the sibling data
			<br>
			<a href='/DURC/sibling/create'>Add new sibling</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\sibling::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$sibling_field = \App\sibling::getNameField();	
	$joined_select_field_sql .= "
, A_sibling.$sibling_field  AS step_$sibling_field
"; 
	$sibling_img_field = \App\sibling::getImgField();
	if(!is_null($sibling_img_field)){
		if($is_debug){echo "sibling has an image field of: |$sibling_img_field|
";}
		$joined_select_field_sql .= "
, A_sibling.$sibling_img_field  AS step_$sibling_img_field
"; 
	}

	$sibling_field = \App\sibling::getNameField();	
	$joined_select_field_sql .= "
, B_sibling.$sibling_field  AS $sibling_field
"; 
	$sibling_img_field = \App\sibling::getImgField();
	if(!is_null($sibling_img_field)){
		if($is_debug){echo "sibling has an image field of: |$sibling_img_field|
";}
		$joined_select_field_sql .= "
, B_sibling.$sibling_img_field  AS $sibling_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
sibling.id
$joined_select_field_sql 
, sibling.siblingname AS siblingname
, sibling.step_sibling_id AS step_sibling_id
, sibling.sibling_id AS sibling_id
, sibling.created_at AS created_at
, sibling.updated_at AS updated_at

FROM aaaDurctest.sibling

LEFT JOIN aaaDurctest.sibling AS A_sibling ON 
	A_sibling.id =
	sibling.step_sibling_id

LEFT JOIN aaaDurctest.sibling AS B_sibling ON 
	B_sibling.id =
	sibling.sibling_id

";

        }else{

                $sql = "
SELECT
sibling.id 
$joined_select_field_sql
, sibling.siblingname AS siblingname
, sibling.step_sibling_id AS step_sibling_id
, sibling.sibling_id AS sibling_id
, sibling.created_at AS created_at
, sibling.updated_at AS updated_at
 
FROM aaaDurctest.sibling 

LEFT JOIN aaaDurctest.sibling AS A_sibling ON 
	A_sibling.id =
	sibling.step_sibling_id

LEFT JOIN aaaDurctest.sibling AS B_sibling ON 
	B_sibling.id =
	sibling.sibling_id

WHERE sibling.id = $index
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
	$img_field_name = \App\sibling::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$sibling_field = \App\sibling::getNameField();	
	$joined_select_field_sql .= "
, A_sibling.$sibling_field  AS step_$sibling_field
"; 
	$sibling_img_field = \App\sibling::getImgField();
	if(!is_null($sibling_img_field)){
		if($is_debug){echo "sibling has an image field of: |$sibling_img_field|
";}
		$joined_select_field_sql .= "
, A_sibling.$sibling_img_field  AS step_$sibling_img_field
"; 
	}

	$sibling_field = \App\sibling::getNameField();	
	$joined_select_field_sql .= "
, B_sibling.$sibling_field  AS $sibling_field
"; 
	$sibling_img_field = \App\sibling::getImgField();
	if(!is_null($sibling_img_field)){
		if($is_debug){echo "sibling has an image field of: |$sibling_img_field|
";}
		$joined_select_field_sql .= "
, B_sibling.$sibling_img_field  AS $sibling_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/sibling/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$step_sibling_tmp = 'step_'.$sibling_field;
if(isset($row[$step_sibling_tmp])){
	$step_sibling_data = $row[$step_sibling_tmp];
	$row[$step_sibling_tmp] = "<a target='_blank' href='/Zermelo/DURC_sibling/$step_sibling_id'>$step_sibling_data</a>";
}

$step_sibling_img_tmp = 'step_'.$sibling_img_field;
if(isset($row[$step_sibling_img_tmp]) && strlen($step_sibling_img_tmp) > 0){
	$step_sibling_img_data = $row[$step_sibling_img_tmp];
	$row[$step_sibling_img_tmp] = "<img width='200px' src='$step_sibling_img_data'>";
}

$sibling_tmp = ''.$sibling_field;
if(isset($row[$sibling_tmp])){
	$sibling_data = $row[$sibling_tmp];
	$row[$sibling_tmp] = "<a target='_blank' href='/Zermelo/DURC_sibling/$sibling_id'>$sibling_data</a>";
}

$sibling_img_tmp = ''.$sibling_img_field;
if(isset($row[$sibling_img_tmp]) && strlen($sibling_img_tmp) > 0){
	$sibling_img_data = $row[$sibling_img_tmp];
	$row[$sibling_img_tmp] = "<img width='200px' src='$sibling_img_data'>";
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
    'column_name' => 'siblingname',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  2 => 
  array (
    'column_name' => 'step_sibling_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'sibling',
  ),
  3 => 
  array (
    'column_name' => 'sibling_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'sibling',
  ),
  4 => 
  array (
    'column_name' => 'created_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  5 => 
  array (
    'column_name' => 'updated_at',
    'data_type' => 'datetime',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
)
//has_many
array (
  'step_sibling' => 
  array (
    'prefix' => 'step',
    'type' => 'sibling',
    'from_table' => 'sibling',
    'from_db' => 'aaaDurctest',
    'from_column' => 'step_sibling_id',
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
        'column_name' => 'siblingname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'step_sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      3 => 
      array (
        'column_name' => 'sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      4 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
  'sibling' => 
  array (
    'prefix' => NULL,
    'type' => 'sibling',
    'from_table' => 'sibling',
    'from_db' => 'aaaDurctest',
    'from_column' => 'sibling_id',
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
        'column_name' => 'siblingname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'step_sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      3 => 
      array (
        'column_name' => 'sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      4 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
)
//has_one
NULL
//belongs_to
array (
  'step_sibling' => 
  array (
    'prefix' => 'step',
    'type' => 'sibling',
    'to_table' => 'sibling',
    'to_db' => 'aaaDurctest',
    'local_key' => 'step_sibling_id',
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
        'column_name' => 'siblingname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'step_sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      3 => 
      array (
        'column_name' => 'sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      4 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
  'sibling' => 
  array (
    'prefix' => NULL,
    'type' => 'sibling',
    'to_table' => 'sibling',
    'to_db' => 'aaaDurctest',
    'local_key' => 'sibling_id',
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
        'column_name' => 'siblingname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'step_sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      3 => 
      array (
        'column_name' => 'sibling_id',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => true,
        'foreign_db' => 'aaaDurctest',
        'foreign_table' => 'sibling',
      ),
      4 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      5 => 
      array (
        'column_name' => 'updated_at',
        'data_type' => 'datetime',
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