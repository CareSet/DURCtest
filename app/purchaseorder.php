<?php
/*
Note: because this file was signed, everything originally placed before the name space line has been replaced... with this comment ;)
FILE_SIG=b17d46f42f7324f888f45c2d083ebab3
*/
namespace App;
/*
	purchaseorder: controls northwind_data.purchaseOrder

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class purchaseorder extends \App\DURC\Models\purchaseorder
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
			'inventorytransaction', //from from many
			'orderdetail', //from from many
			'purchaseorderdetail', //from from many
			'supplier', //from belongs to
			'createdBy_employee', //from belongs to
			'approvedBy_employee', //from belongs to
			'submittedBy_employee', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'supplier_id', //int
			//'createdBy_employee_id', //int
			//'submittedDate', //datetime
			//'creationDate', //datetime
			//'status_id', //int
			//'expectedDate', //datetime
			//'shippingFee', //decimal
			//'taxes', //decimal
			//'paymentDate', //datetime
			//'paymentAmount', //decimal
			//'paymentMethod', //varchar
			//'notes', //longtext
			//'approvedBy_employee_id', //int
			//'approvedDate', //datetime
			//'submittedBy_employee_id', //int
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the inventorytransaction for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function inventorytransaction(){
		return parent::inventorytransaction();
	}


/**
*	DURC is handling the orderdetail for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function orderdetail(){
		return parent::orderdetail();
	}


/**
*	DURC is handling the purchaseorderdetail for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorderdetail(){
		return parent::purchaseorderdetail();
	}


//DURC BELONGS_TO SECTION

/**
*	DURC is handling the supplier for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function supplier(){
		return parent::supplier();
	}


/**
*	DURC is handling the createdBy_employee for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function createdBy_employee(){
		return parent::createdBy_employee();
	}


/**
*	DURC is handling the approvedBy_employee for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function approvedBy_employee(){
		return parent::approvedBy_employee();
	}


/**
*	DURC is handling the submittedBy_employee for this purchaseorder in purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function submittedBy_employee(){
		return parent::submittedBy_employee();
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
	

}//end purchaseorder