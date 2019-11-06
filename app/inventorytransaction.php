<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=1d675224bb7a7428825e15d98f167dd2
*/
namespace App;
/*
	inventorytransaction: controls northwind_data.inventoryTransaction

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class inventorytransaction extends \App\DURC\Models\inventorytransaction
{
	//this controls what is downloaded in the json for this object under card_body.. 
	//this function returns the html snippet that should be loaded for the summary of this object in a bootstrap card
	//read about the structure here: https://getbootstrap.com/docs/4.3/components/card/
	//this function should return an html snippet to go in the first 'card-body' div of an HTML interface...
	public function getCardBody() {
		return parent::getCardBody(); //just use the standard one unless a user over-rides this..
	}


	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'product', //from belongs to
			'purchaseorder', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'transactionType', //tinyint
			//'transactionCreatedDate', //datetime
			//'transactionModifiedDate', //datetime
			//'product_id', //int
			//'quantity', //int
			//'purchaseOrder_id', //int
			//'customerOrder_id', //int
			//'comments', //varchar
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION

/**
*	DURC is handling the product for this inventorytransaction in inventorytransaction
*       but you can extend or override the defaults by editing this function...
*/
	public function product(){
		return parent::product();
	}


/**
*	DURC is handling the purchaseorder for this inventorytransaction in inventorytransaction
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorder(){
		return parent::purchaseorder();
	}



	//look in the parent class for the SQL used to generate the underlying table

	//add fields here to entirely hide them in the default DURC web interface.
        public static $UX_hidden_col = [
        ];

        public static function isFieldHiddenInGenericDurcEditor($field){
                if(in_array($field,self::$UX_hidden_col)){
                        return(true);
                }
        }

	//add fields here to make them view-only in the default DURC web interface
        public static $UX_view_only_col = [
        ];

        public static function isFieldViewOnlyInGenericDurcEditor($field){
                if(in_array($field,self::$UX_view_only_col)){
                        return(true);
                }
        }

	//your stuff goes here..
	

}//end inventorytransaction