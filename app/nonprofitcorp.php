<?php

namespace App;
/*
	nonprofitcorp: controls irs.nonprofitcorp

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class nonprofitcorp extends \App\DURC\Models\DURC_nonprofitcorp
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'donation', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'EIN', //int
			//'TAXPAYER_NAME', //varchar
		]; //end hidden array

//DURC HAS_MANY SECTION
/**
*	DURC is handling the donation for this nonprofitcorp in DURC_nonprofitcorp
*       but you can extend or override the defaults by editing this function...
*/
	public function donation(){
		return parent::donation();
	}

//DURC BELONGS_TO SECTION			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end nonprofitcorp