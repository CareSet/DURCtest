<?php

namespace App;
/*
	purchaseorder: controls northwind_data.purchaseOrder

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class purchaseorder extends \App\DURC\Models\DURC_purchaseorder
{

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
*	DURC is handling the inventorytransaction for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function inventorytransaction(){
		return parent::inventorytransaction();
	}


/**
*	DURC is handling the orderdetail for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function orderdetail(){
		return parent::orderdetail();
	}


/**
*	DURC is handling the purchaseorderdetail for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorderdetail(){
		return parent::purchaseorderdetail();
	}

//DURC BELONGS_TO SECTION
/**
*	DURC is handling the supplier for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function supplier(){
		return parent::supplier();
	}


/**
*	DURC is handling the createdBy_employee for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function createdBy_employee(){
		return parent::createdBy_employee();
	}


/**
*	DURC is handling the approvedBy_employee for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function approvedBy_employee(){
		return parent::approvedBy_employee();
	}


/**
*	DURC is handling the submittedBy_employee for this purchaseorder in DURC_purchaseorder
*       but you can extend or override the defaults by editing this function...
*/
	public function submittedBy_employee(){
		return parent::submittedBy_employee();
	}


	//your stuff goes here..
	

}//end purchaseorder