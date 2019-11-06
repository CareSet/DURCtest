<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=1ed398658df38b0127c20246918b332d
*/
namespace App\Reports;
use CareSet\Zermelo\Reports\Tabular\AbstractTabularReport;

class DURC_donation extends AbstractTabularReport
{

    //returns the name of the report
    public function GetReportName(): string {
        $report_name = "donation Report";
        return($report_name);
    }

    //returns the description of the report. HTML is allowed here.
    public function GetReportDescription(): ?string {
        $desc = "View the donation data
			<br>
			<a href='/DURC/donation/create'>Add new donation</a>
";
        return($desc);
    }

    //  returns the SQL for the report.  This is the workhorse of the report.
    public function GetSQL()
    {

        $is_debug = false; //lots of debugging echos will be show instead of the report

        $index = $this->getCode();


	//get the local image field for this report... null if not found..
	$img_field_name = \App\donation::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$nonprofitcorp_field = \App\nonprofitcorp::getNameField();	
	$joined_select_field_sql .= "
, A_nonprofitcorp.$nonprofitcorp_field  AS $nonprofitcorp_field
"; 
	$nonprofitcorp_img_field = \App\nonprofitcorp::getImgField();
	if(!is_null($nonprofitcorp_img_field)){
		if($is_debug){echo "nonprofitcorp has an image field of: |$nonprofitcorp_img_field|
";}
		$joined_select_field_sql .= "
, A_nonprofitcorp.$nonprofitcorp_img_field  AS $nonprofitcorp_img_field
"; 
	}


        if(is_null($index)){

                $sql = "
SELECT
donation.id
$joined_select_field_sql 
, donation.amount AS amount
, donation.nonprofitcorp_id AS nonprofitcorp_id
, donation.created_at AS created_at
, donation.updated_at AS updated_at
, donation.deleted_at AS deleted_at

FROM aaaDurctest.donation

LEFT JOIN irs.nonprofitcorp AS A_nonprofitcorp ON 
	A_nonprofitcorp.id =
	donation.nonprofitcorp_id

";

        }else{

                $sql = "
SELECT
donation.id 
$joined_select_field_sql
, donation.amount AS amount
, donation.nonprofitcorp_id AS nonprofitcorp_id
, donation.created_at AS created_at
, donation.updated_at AS updated_at
, donation.deleted_at AS deleted_at
 
FROM aaaDurctest.donation 

LEFT JOIN irs.nonprofitcorp AS A_nonprofitcorp ON 
	A_nonprofitcorp.id =
	donation.nonprofitcorp_id

WHERE donation.id = $index
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
	$img_field_name = \App\donation::getImgField();
	if(isset($$img_field_name)){
		$img_field = $$img_field_name;
	}else{
		$img_field = null;
	}

	$joined_select_field_sql  = '';



	$nonprofitcorp_field = \App\nonprofitcorp::getNameField();	
	$joined_select_field_sql .= "
, A_nonprofitcorp.$nonprofitcorp_field  AS $nonprofitcorp_field
"; 
	$nonprofitcorp_img_field = \App\nonprofitcorp::getImgField();
	if(!is_null($nonprofitcorp_img_field)){
		if($is_debug){echo "nonprofitcorp has an image field of: |$nonprofitcorp_img_field|
";}
		$joined_select_field_sql .= "
, A_nonprofitcorp.$nonprofitcorp_img_field  AS $nonprofitcorp_img_field
"; 
	}



        //link this row to its DURC editor
        $row['id'] = "<a href='/DURC/donation/$id'>$id</a>";



	if(isset($$img_field_name)){  //is it set
		if(strlen($img_field) > 0){ //and it is it really a url..
			$row[$img_field_name] = "<img width='300' src='$img_field'>";
		}
	}



$nonprofitcorp_tmp = ''.$nonprofitcorp_field;
if(isset($row[$nonprofitcorp_tmp])){
	$nonprofitcorp_data = $row[$nonprofitcorp_tmp];
	$row[$nonprofitcorp_tmp] = "<a target='_blank' href='/Zermelo/DURC_nonprofitcorp/$nonprofitcorp_id'>$nonprofitcorp_data</a>";
}

$nonprofitcorp_img_tmp = ''.$nonprofitcorp_img_field;
if(isset($row[$nonprofitcorp_img_tmp]) && strlen($nonprofitcorp_img_tmp) > 0){
	$nonprofitcorp_img_data = $row[$nonprofitcorp_img_tmp];
	$row[$nonprofitcorp_img_tmp] = "<img width='200px' src='$nonprofitcorp_img_data'>";
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
    'column_name' => 'amount',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => false,
    'foreign_db' => NULL,
    'foreign_table' => NULL,
  ),
  2 => 
  array (
    'column_name' => 'nonprofitcorp_id',
    'data_type' => 'int',
    'is_primary_key' => false,
    'is_foreign_key' => false,
    'is_linked_key' => true,
    'foreign_db' => 'irs',
    'foreign_table' => 'nonprofitcorp',
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
  5 => 
  array (
    'column_name' => 'deleted_at',
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
array (
  'nonprofitcorp' => 
  array (
    'prefix' => NULL,
    'type' => 'nonprofitcorp',
    'to_table' => 'nonprofitcorp',
    'to_db' => 'irs',
    'local_key' => 'nonprofitcorp_id',
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
        'column_name' => 'EIN',
        'data_type' => 'int',
        'is_primary_key' => false,
        'is_foreign_key' => false,
        'is_linked_key' => false,
        'foreign_db' => NULL,
        'foreign_table' => NULL,
      ),
      2 => 
      array (
        'column_name' => 'TAXPAYER_NAME',
        'data_type' => 'varchar',
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