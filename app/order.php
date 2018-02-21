<?php

namespace App;
/*
	order: controls northwind_data.order

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class order extends \App\DURC\Models\order
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'invoice', //from from many
			'orderdetail', //from from many
			'employee', //from belongs to
			'customer', //from belongs to
			'shipper', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'employee_id', //int
			//'customer_id', //int
			//'orderDate', //datetime
			//'shippedDate', //datetime
			//'shipper_id', //int
			//'shipName', //varchar
			//'shipAddress', //longtext
			//'shipCity', //varchar
			//'shipStateProvince', //varchar
			//'shipZipPostalCode', //varchar
			//'shipCountryRegion', //varchar
			//'shippingFee', //decimal
			//'taxes', //decimal
			//'paymentType', //varchar
			//'paidDate', //datetime
			//'notes', //longtext
			//'taxRate', //double
			//'taxStatus_id', //tinyint
			//'status_id', //tinyint
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the invoice for this order in order
*       but you can extend or override the defaults by editing this function...
*/
	public function invoice(){
		return parent::invoice();
	}


/**
*	DURC is handling the orderdetail for this order in order
*       but you can extend or override the defaults by editing this function...
*/
	public function orderdetail(){
		return parent::orderdetail();
	}


//DURC BELONGS_TO SECTION

/**
*	DURC is handling the employee for this order in order
*       but you can extend or override the defaults by editing this function...
*/
	public function employee(){
		return parent::employee();
	}


/**
*	DURC is handling the customer for this order in order
*       but you can extend or override the defaults by editing this function...
*/
	public function customer(){
		return parent::customer();
	}


/**
*	DURC is handling the shipper for this order in order
*       but you can extend or override the defaults by editing this function...
*/
	public function shipper(){
		return parent::shipper();
	}


	//your stuff goes here..
	

}//end order