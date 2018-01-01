<?php

namespace App;
/*
	donation: controls aaaDurctest.donation

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class donation extends \App\DURC\Models\DURC_donation
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'nonprofitcorp', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'amount', //int
			//'nonprofitcorp_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
			//'deleted_at', //datetime
		]; //end hidden array

//DURC HAS_MANY SECTION			//DURC did not detect any has_many relationships//DURC BELONGS_TO SECTION
/**
*	DURC is handling the nonprofitcorp for this donation in DURC_donation
*       but you can extend or override the defaults by editing this function...
*/
	public function nonprofitcorp(){
		return parent::nonprofitcorp();
	}


	//your stuff goes here..
	

}//end donation