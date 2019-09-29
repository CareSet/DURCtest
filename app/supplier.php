<?php

namespace App;
/*
	supplier: controls northwind_model.supplier

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class supplier extends \App\DURC\Models\supplier
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'purchaseorder', //from from many
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
*	DURC is handling the purchaseorder for this supplier in supplier
*       but you can extend or override the defaults by editing this function...
*/
	public function purchaseorder(){
		return parent::purchaseorder();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end supplier