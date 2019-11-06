<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=2bea195adbc07acc1988dce1a82971be
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_tags_report extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "tags_report Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the tags_report data
			<br>
			<a href='/DURC/tags_report/create'>Add new tags_report</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\tags_report::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';




        if(is_null($index)){

                $sql = "
SELECT
tags_report.id
$joined_select_field_sql 
, tags_report.field_to_bold_in_report_display AS field_to_bold_in_report_display
, tags_report.field_to_hide_by_default AS field_to_hide_by_default
, tags_report.field_to_italic_in_report_display AS field_to_italic_in_report_display
, tags_report.field_to_right_align_in_report AS field_to_right_align_in_report
, tags_report.field_to_bolditalic_in_report_display AS field_to_bolditalic_in_report_display
, tags_report.numeric_field AS numeric_field
, tags_report.decimal_field AS decimal_field
, tags_report.currency_field AS currency_field
, tags_report.percent_field AS percent_field
, tags_report.url_field AS url_field
, tags_report.time_field AS time_field
, tags_report.date_field AS date_field
, tags_report.datetime_field AS datetime_field

FROM northwind_data.tags_report

";

        }else{

                $sql = "
SELECT
tags_report.id 
$joined_select_field_sql
, tags_report.field_to_bold_in_report_display AS field_to_bold_in_report_display
, tags_report.field_to_hide_by_default AS field_to_hide_by_default
, tags_report.field_to_italic_in_report_display AS field_to_italic_in_report_display
, tags_report.field_to_right_align_in_report AS field_to_right_align_in_report
, tags_report.field_to_bolditalic_in_report_display AS field_to_bolditalic_in_report_display
, tags_report.numeric_field AS numeric_field
, tags_report.decimal_field AS decimal_field
, tags_report.currency_field AS currency_field
, tags_report.percent_field AS percent_field
, tags_report.url_field AS url_field
, tags_report.time_field AS time_field
, tags_report.date_field AS date_field
, tags_report.datetime_field AS datetime_field
 
FROM northwind_data.tags_report 

WHERE tags_report.id = $index
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
	$img_field_name = \App\tags_report::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';





        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/tags_report/$id'>$id</a>";



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
    'data_type' => 'bigint',
    'is_primary_key' => true,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  1 => 
  array (
    'column_name' => 'field_to_bold_in_report_display',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  2 => 
  array (
    'column_name' => 'field_to_hide_by_default',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  3 => 
  array (
    'column_name' => 'field_to_italic_in_report_display',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  4 => 
  array (
    'column_name' => 'field_to_right_align_in_report',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  5 => 
  array (
    'column_name' => 'field_to_bolditalic_in_report_display',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  6 => 
  array (
    'column_name' => 'numeric_field',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  7 => 
  array (
    'column_name' => 'decimal_field',
    'data_type' => 'decimal',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  8 => 
  array (
    'column_name' => 'currency_field',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  9 => 
  array (
    'column_name' => 'percent_field',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  10 => 
  array (
    'column_name' => 'url_field',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  11 => 
  array (
    'column_name' => 'time_field',
    'data_type' => 'time',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  12 => 
  array (
    'column_name' => 'date_field',
    'data_type' => 'date',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  13 => 
  array (
    'column_name' => 'datetime_field',
    'data_type' => 'datetime',
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
NULL
//many_many
NULL
//many_through
NULL*/


?>