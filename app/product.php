<?php

namespace App;
/*
	product: controls northwind_model.product

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class product extends \App\DURC\Models\product
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'inventorytransaction', //from from many
			'orderdetail', //from from many
			'purchaseorderdetail', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'supplier_ids', //longtext
			//'id', //int
			//'productCode', //varchar
			//'productName', //varchar
			//'description', //longtext
			//'standardCost', //decimal
			//'listPrice', //decimal
			//'reorderLevel', //int
			//'targetLevel', //int
			//'quantityPerUnit', //varchar
			//'discontinued', //tinyint
			//'minimumReorderQuantity', //int
			//'category', //varchar
			//'attachments', //longblob
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the inventorytransaction for this product in product
*       but you can extend or override the defaults by editing this function...
*/
	public function inventorytransaction(){
		return parent::inventorytransaction();
	}


/**
*	DURC is handling the orderdetail for this product in product
*       but you can extend or override the defaults by editing this function...
*/
	public function orderdetail(){
		return parent::orderdetail();
	}


/**
*	DURC is handling the purchaseorderdetail for this product in product
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorderdetail(){
		return parent::purchaseorderdetail();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end product