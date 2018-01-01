<?php

namespace App;
/*
	employee: controls northwind_model.employee

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class employee extends \App\DURC\Models\DURC_employee
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'order', //from from many
			'createdBy_purchaseorder', //from from many
			'approvedBy_purchaseorder', //from from many
			'submittedBy_purchaseorder', //from from many
			'employeeprivilege', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'company', //varchar
			//'lastName', //varchar
			//'firstName', //varchar
			//'emailAddress', //varchar
			//'jobTitle', //varchar
			//'businessPhone', //varchar
			//'homePhone', //varchar
			//'mobilePhone', //varchar
			//'faxNumber', //varchar
			//'address', //longtext
			//'city', //varchar
			//'stateProvince', //varchar
			//'zipPostalCode', //varchar
			//'countryRegion', //varchar
			//'webPage', //longtext
			//'notes', //longtext
			//'attachments', //longblob
		]; //end hidden array

//DURC HAS_MANY SECTION
/**
*	DURC is handling the order for this employee in DURC_employee
*       but you can extend or override the defaults by editing this function...
*/
	public function order(){
		return parent::order();
	}


/**
*	DURC is handling the createdBy_purchaseorder for this employee in DURC_employee
*       but you can extend or override the defaults by editing this function...
*/
	public function createdBy_purchaseorder(){
		return parent::createdBy_purchaseorder();
	}


/**
*	DURC is handling the approvedBy_purchaseorder for this employee in DURC_employee
*       but you can extend or override the defaults by editing this function...
*/
	public function approvedBy_purchaseorder(){
		return parent::approvedBy_purchaseorder();
	}


/**
*	DURC is handling the submittedBy_purchaseorder for this employee in DURC_employee
*       but you can extend or override the defaults by editing this function...
*/
	public function submittedBy_purchaseorder(){
		return parent::submittedBy_purchaseorder();
	}


/**
*	DURC is handling the employeeprivilege for this employee in DURC_employee
*       but you can extend or override the defaults by editing this function...
*/
	public function employeeprivilege(){
		return parent::employeeprivilege();
	}

//DURC BELONGS_TO SECTION			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end employee