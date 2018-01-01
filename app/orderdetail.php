<?php

namespace App;
/*
	orderdetail: controls northwind_data.orderDetail

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class orderdetail extends \App\DURC\Models\DURC_orderdetail
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'order', //from belongs to
			'product', //from belongs to
			'purchaseorder', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'order_id', //int
			//'product_id', //int
			//'quantity', //decimal
			//'unitPrice', //decimal
			//'discount', //double
			//'status_id', //int
			//'dateAllocated', //datetime
			//'PurchaseOrder_id', //int
			//'inventory_id', //int
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION
/**
*	DURC is handling the order for this orderdetail in DURC_orderdetail
*       but you can extend or override the defaults by editing this function...
*/
	public function order(){
		return parent::order();
	}


/**
*	DURC is handling the product for this orderdetail in DURC_orderdetail
*       but you can extend or override the defaults by editing this function...
*/
	public function product(){
		return parent::product();
	}


/**
*	DURC is handling the purchaseorder for this orderdetail in DURC_orderdetail
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorder(){
		return parent::purchaseorder();
	}


	//your stuff goes here..
	

}//end orderdetail