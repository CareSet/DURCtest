<?php

namespace App;
/*
	orderstat: controls northwind_model.orderStat

This class started life as a DURC model, but itwill no longer be overwritten by the generator
this is safe to edit.


*/
class orderstat extends \App\DURC\Models\orderstat
{

	//You may need to change these for 'one to very very many' relationships.
/*
		protected $DURC_selfish_with = [ 
		];

*/
	//you can uncomment fields to prevent them from being serialized into the API!
	protected  $hidden = [
			//'id', //tinyint
			//'statusName', //varchar
		]; //end hidden array


//DURC HAS_MANY SECTION
			//DURC did not detect any has_many relationships
//DURC BELONGS_TO SECTION
			//DURC did not detect any belongs_to relationships
	//your stuff goes here..
	

}//end orderstat