<?php

namespace App;
/*
	purchaseorderdetail: controls northwind_data.purchaseOrderDetail

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class purchaseorderdetail extends \App\DURC\Models\DURC_purchaseorderdetail
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'purchaseorder', //from belongs to
			'product', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'purchaseOrder_id', //int
			//'product_id', //int
			//'quantity', //decimal
			//'unitCost', //decimal
			//'dateReceived', //datetime
			//'postedToInventory', //tinyint
			//'inventory_id', //int
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION
/**
*	DURC is handling the purchaseorder for this purchaseorderdetail in DURC_purchaseorderdetail
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorder(){
		return parent::purchaseorder();
	}


/**
*	DURC is handling the product for this purchaseorderdetail in DURC_purchaseorderdetail
*       but you can extend or override the defaults by editing this function...
*/
	public function product(){
		return parent::product();
	}


	//your stuff goes here..
	

}//end purchaseorderdetail