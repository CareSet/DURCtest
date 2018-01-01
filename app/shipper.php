<?php

namespace App;
/*
	shipper: controls northwind_model.shipper

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class shipper extends \App\DURC\Models\DURC_shipper
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'order', //from from many
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
*	DURC is handling the order for this shipper in DURC_shipper
*       but you can extend or override the defaults by editing this function...
*/
	public function order(){
		return parent::order();
	}

//DURC BELONGS_TO SECTION			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end shipper