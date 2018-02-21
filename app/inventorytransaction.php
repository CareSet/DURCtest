<?php

namespace App;
/*
	inventorytransaction: controls northwind_data.inventoryTransaction

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class inventorytransaction extends \App\DURC\Models\inventorytransaction
{

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


	//your stuff goes here..
	

}//end inventorytransaction