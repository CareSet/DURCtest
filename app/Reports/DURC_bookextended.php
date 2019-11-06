<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=e6dd0902c94778fd4697bc4fc39e0185
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_bookextended extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "bookextended Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the bookextended data
			<br>
			<a href='/DURC/bookextended/create'>Add new bookextended</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\bookextended::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$book_field = \App\book::getNameField();	
	$joined_select_field_sql .= "
, A_book.$book_field  AS $book_field
"; 
	$book_img_field = \App\book::getImgField();
	if(!is_null($book_img_field)){
		if($is_debug){echo "book has an image field of: |$book_img_field|
";}
		$joined_select_field_sql .= "
, A_book.$book_img_field  AS $book_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
bookextended.id
$joined_select_field_sql 
, bookextended.book_id AS book_id
, bookextended.ISBN AS ISBN
, bookextended.local_isle AS local_isle
, bookextended.local_shelf AS local_shelf

FROM aaaDurctest.bookextended

LEFT JOIN aaaDurctest.book AS A_book ON 
	A_book.id =
	bookextended.book_id

";

        }else{

                $sql = "
SELECT
bookextended.id 
$joined_select_field_sql
, bookextended.book_id AS book_id
, bookextended.ISBN AS ISBN
, bookextended.local_isle AS local_isle
, bookextended.local_shelf AS local_shelf
 
FROM aaaDurctest.bookextended 

LEFT JOIN aaaDurctest.book AS A_book ON 
	A_book.id =
	bookextended.book_id

WHERE bookextended.id = $index
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
	$img_field_name = \App\bookextended::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$book_field = \App\book::getNameField();	
	$joined_select_field_sql .= "
, A_book.$book_field  AS $book_field
"; 
	$book_img_field = \App\book::getImgField();
	if(!is_null($book_img_field)){
		if($is_debug){echo "book has an image field of: |$book_img_field|
";}
		$joined_select_field_sql .= "
, A_book.$book_img_field  AS $book_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/bookextended/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$book_tmp = ''.$book_field;
if(isset($row[$book_tmp])){
	$book_data = $row[$book_tmp];
	$row[$book_tmp] = "<a target='_blank' href='/Zermelo/DURC_book/$book_id'>$book_data</a>";
}

$book_img_tmp = ''.$book_img_field;
if(isset($row[$book_img_tmp]) && strlen($book_img_tmp) > 0){
	$book_img_data = $row[$book_img_tmp];
	$row[$book_img_tmp] = "<img width='200px' src='$book_img_data'>";
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
    'column_name' => 'book_id',
    'data_type' => 'int',
    'is_primary_key' => true,
    'is_foreign_key' => true,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'book',
  ),
  1 => 
  array (
    'column_name' => 'ISBN',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  2 => 
  array (
    'column_name' => 'local_isle',
    'data_type' => 'varchar',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  3 => 
  array (
    'column_name' => 'local_shelf',
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
  'book' => 
  array (
    'prefix' => NULL,
    'type' => 'book',
    'to_table' => 'book',
    'to_db' => 'aaaDurctest',
    'local_key' => 'book_id',
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
        'column_name' => 'title',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'release_date',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
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