<?php

namespace App;
/*
	sibling: controls aaaDurctest.sibling

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class sibling extends \App\DURC\Models\sibling
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'step_sibling', //from from many
			'sibling', //from from many
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
*	DURC is handling the step_sibling for this sibling in sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function step_sibling(){
		return parent::step_sibling();
	}


/**
*	DURC is handling the sibling for this sibling in sibling
*       but you can extend or override the defaults by editing this function...
*/
	public function sibling(){
		return parent::sibling();
	}


//DURC BELONGS_TO SECTION

		//DURC would have added step_sibling but it was already used in has_many. 
		//You will have to resolve these recursive relationships in your code.
		//DURC would have added sibling but it was already used in has_many. 
		//You will have to resolve these recursive relationships in your code.
	//your stuff goes here..
	

}//end sibling