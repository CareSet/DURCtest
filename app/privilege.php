<?php

namespace App;
/*
	privilege: controls northwind_model.privilege

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class privilege extends \App\DURC\Models\privilege
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
			'employeeprivilege', //from from many
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //int
			//'privilegeName', //varchar
		]; //end hidden array


//DURC HAS_MANY SECTION

/**
*	DURC is handling the employeeprivilege for this privilege in privilege
*       but you can extend or override the defaults by editing this function...
*/
	public function employeeprivilege(){
		return parent::employeeprivilege();
	}


//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end privilege