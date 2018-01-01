<?php

namespace App;
/*
	sibling: controls aaaDurctest.sibling

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.

DURC Generated At: Monday 1st of January 2018 04:58:04 PM

*/
class sibling extends \App\DURC\Models\DURC_sibling
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'step_sibling', //from belongs to
			'sibling', //from belongs to
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'siblingname', //varchar
			//'step_sibling_id', //int
			//'sibling_id', //int
			//'created_at', //datetime
			//'updated_at', //datetime
		]; //end hidden array

//DURC HAS_MANY SECTION
/**
*	DURC is handling the step_sibling for this sibling in DURC_sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function step_sibling(){
		return parent::step_sibling();
	}


/**
*	DURC is handling the sibling for this sibling in DURC_sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function sibling(){
		return parent::sibling();
	}

//DURC BELONGS_TO SECTION
/**
*	DURC is handling the step_sibling for this sibling in DURC_sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function step_sibling(){
		return parent::step_sibling();
	}


/**
*	DURC is handling the sibling for this sibling in DURC_sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function sibling(){
		return parent::sibling();
	}


	//your stuff goes here..
	

}//end sibling