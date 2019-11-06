<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=0abf9be5d3795706e2060af4d227c114
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_author_book extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "author_book Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the author_book data
			<br>
			<a href='/DURC/author_book/create'>Add new author_book</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\author_book::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$author_field = \App\author::getNameField();	
	$joined_select_field_sql .= "
, A_author.$author_field  AS $author_field
"; 
	$author_img_field = \App\author::getImgField();
	if(!is_null($author_img_field)){
		if($is_debug){echo "author has an image field of: |$author_img_field|
";}
		$joined_select_field_sql .= "
, A_author.$author_img_field  AS $author_img_field
"; 
	}

	$book_field = \App\book::getNameField();	
	$joined_select_field_sql .= "
, B_book.$book_field  AS $book_field
"; 
	$book_img_field = \App\book::getImgField();
	if(!is_null($book_img_field)){
		if($is_debug){echo "book has an image field of: |$book_img_field|
";}
		$joined_select_field_sql .= "
, B_book.$book_img_field  AS $book_img_field
"; 
	}

	$authortype_field = \App\authortype::getNameField();	
	$joined_select_field_sql .= "
, C_authortype.$authortype_field  AS $authortype_field
"; 
	$authortype_img_field = \App\authortype::getImgField();
	if(!is_null($authortype_img_field)){
		if($is_debug){echo "authortype has an image field of: |$authortype_img_field|
";}
		$joined_select_field_sql .= "
, C_authortype.$authortype_img_field  AS $authortype_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
author_book.id
$joined_select_field_sql 
, author_book.author_id AS author_id
, author_book.book_id AS book_id
, author_book.authortype_id AS authortype_id

FROM aaaDurctest.author_book

LEFT JOIN aaaDurctest.author AS A_author ON 
	A_author.id =
	author_book.author_id

LEFT JOIN aaaDurctest.book AS B_book ON 
	B_book.id =
	author_book.book_id

LEFT JOIN aaaDurctest.authortype AS C_authortype ON 
	C_authortype.id =
	author_book.authortype_id

";

        }else{

                $sql = "
SELECT
author_book.id 
$joined_select_field_sql
, author_book.author_id AS author_id
, author_book.book_id AS book_id
, author_book.authortype_id AS authortype_id
 
FROM aaaDurctest.author_book 

LEFT JOIN aaaDurctest.author AS A_author ON 
	A_author.id =
	author_book.author_id

LEFT JOIN aaaDurctest.book AS B_book ON 
	B_book.id =
	author_book.book_id

LEFT JOIN aaaDurctest.authortype AS C_authortype ON 
	C_authortype.id =
	author_book.authortype_id

WHERE author_book.id = $index
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
	$img_field_name = \App\author_book::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$author_field = \App\author::getNameField();	
	$joined_select_field_sql .= "
, A_author.$author_field  AS $author_field
"; 
	$author_img_field = \App\author::getImgField();
	if(!is_null($author_img_field)){
		if($is_debug){echo "author has an image field of: |$author_img_field|
";}
		$joined_select_field_sql .= "
, A_author.$author_img_field  AS $author_img_field
"; 
	}

	$book_field = \App\book::getNameField();	
	$joined_select_field_sql .= "
, B_book.$book_field  AS $book_field
"; 
	$book_img_field = \App\book::getImgField();
	if(!is_null($book_img_field)){
		if($is_debug){echo "book has an image field of: |$book_img_field|
";}
		$joined_select_field_sql .= "
, B_book.$book_img_field  AS $book_img_field
"; 
	}

	$authortype_field = \App\authortype::getNameField();	
	$joined_select_field_sql .= "
, C_authortype.$authortype_field  AS $authortype_field
"; 
	$authortype_img_field = \App\authortype::getImgField();
	if(!is_null($authortype_img_field)){
		if($is_debug){echo "authortype has an image field of: |$authortype_img_field|
";}
		$joined_select_field_sql .= "
, C_authortype.$authortype_img_field  AS $authortype_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/author_book/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$author_tmp = ''.$author_field;
if(isset($row[$author_tmp])){
	$author_data = $row[$author_tmp];
	$row[$author_tmp] = "<a target='_blank' href='/Zermelo/DURC_author/$author_id'>$author_data</a>";
}

$author_img_tmp = ''.$author_img_field;
if(isset($row[$author_img_tmp]) && strlen($author_img_tmp) > 0){
	$author_img_data = $row[$author_img_tmp];
	$row[$author_img_tmp] = "<img width='200px' src='$author_img_data'>";
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

$authortype_tmp = ''.$authortype_field;
if(isset($row[$authortype_tmp])){
	$authortype_data = $row[$authortype_tmp];
	$row[$authortype_tmp] = "<a target='_blank' href='/Zermelo/DURC_authortype/$authortype_id'>$authortype_data</a>";
}

$authortype_img_tmp = ''.$authortype_img_field;
if(isset($row[$authortype_img_tmp]) && strlen($authortype_img_tmp) > 0){
	$authortype_img_data = $row[$authortype_img_tmp];
	$row[$authortype_img_tmp] = "<img width='200px' src='$authortype_img_data'>";
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
    'column_name' => 'author_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'author',
  ),
  2 => 
  array (
    'column_name' => 'book_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'book',
  ),
  3 => 
  array (
    'column_name' => 'authortype_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'aaaDurctest',
    'foreign_table' => 'authortype',
  ),
)
//has_many
NULL
//has_one
NULL
//belongs_to
array (
  'author' => 
  array (
    'prefix' => NULL,
    'type' => 'author',
    'to_table' => 'author',
    'to_db' => 'aaaDurctest',
    'local_key' => 'author_id',
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
        'column_name' => 'lastname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'firstname',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
      array (
        'column_name' => 'created_date',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      4 => 
      array (
        'column_name' => 'updated_date',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
    ),
  ),
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
  'authortype' => 
  array (
    'prefix' => NULL,
    'type' => 'authortype',
    'to_table' => 'authortype',
    'to_db' => 'aaaDurctest',
    'local_key' => 'authortype_id',
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
        'column_name' => 'authortypedesc',
        'data_type' => 'varchar',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'created_at',
        'data_type' => 'datetime',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      3 => 
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